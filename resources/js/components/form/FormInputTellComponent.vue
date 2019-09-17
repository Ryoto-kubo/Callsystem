<template>
    <div class="form-container" :class="classSwitch">
        <div class="flex-container tell-container">
            <div class="input-container">
                <div>
                    <p>※任意（ハイフンなし）</p>
                </div>
                <div class="input-area">
                    <div class="input">
                        <input id="num-input" v-model="tellNum" type="num" readonly="readonly" placeholder="09012345678">
                    </div>
                </div>
            </div>
            <div class="num-button-container">
                <div class="num-button-area" v-for="item in nums" :key="item.index">
                    <div class="button-back"></div>
                    <button class="btn input-btn" @click="tellNumInput(item)" onfocus="this.blur();">{{ item }}</button>
                </div>
                <div class="num-button-area">
                    <div class="button-back clear-button-back"></div>
                    <button class="btn input-btn clear-btn" type="button" @click="numClear" onfocus="this.blur();">←</button>
                </div>
            </div>
        </div>
        <div class="link-area">
            <div class="btn-container" style="margin-left: 80px;">
                <div class="button-back skip-button-back"></div>
                <button class="btn skip-btn" onfocus="this.blur();">スキップ</button>
            </div>
            <div v-if="nextBtnAppearrance" class="btn-container" style="margin-right: 80px;">
                <div class="button-back background-blue"></div>
                <button id="js-next-btn" class="btn next-btn ripple" onfocus="this.blur();" @click="nextStep" style="padding: 0;">確認</button>
            </div>
            <div v-else class="btn-container" style="margin-right: 80px;">
                <div class="button-back" style="background: #8b0000;"></div>
                <button class="btn waiting-btn ripple" style="background: #f08080;" onfocus="this.blur();"></button>
            </div>
        </div>
        <div class="prev-btn-container">
            <div class="prev-btn-area">
                <div class="prev-button-back"></div>
                <button class="btn prev-btn" type="button" onfocus="this.blur();" @click="prevStep">
                    <font-awesome-icon icon="angle-left" style="width: 40px; height: 40px;" />
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                tellNum: '',
                time: 0,
                classSwitch: null,
                nextBtnAppearrance: false,
                selectTobaccoType: null,
                nums: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
            }
        },
        props: {
            currentId: Number,
        },
        mounted() {
            // 「受付へ進む」からの表示なのか、「前に戻る」からの表示なのかを判定しclassを切り替える
            let passiveState = this.$store.state.status.prevState
            if (passiveState) {
                this.classSwitch = 'passive-active'
                this.$store.dispatch('status/prevForm', { prevState: false })
            } else {
                this.classSwitch = 'active'
            }
            this.time = 0
        },
        methods: {
            tellNumInput(item){
                this.tellNum += item
            },
            numClear(){
                this.tellNum = this.tellNum.slice( 0, -1 ) ;
            },
            nextStep(tellNum){
                this.classSwitch       = 'reactive'
                this.selectTobaccoType = tellNum
                this.$emit('getTellNum', tellNum)
                this.$emit('progressBarMove', this.currentId)
                this.$store.dispatch('status/nextStep', { currentId: this.currentId })
                setTimeout(() => {this.time++ }, 1000)

            },
            prevStep(){
                this.$store.dispatch('status/prevForm', { prevState: true })
                this.classSwitch = 'prev-reactive'
                this.$emit('progressBarMove', this.currentId)
                this.$store.dispatch('status/prevStep', { currentId: this.currentId })
                setTimeout(() => {this.time++ }, 1000)
            }
        },
        watch: {
            tellNum(value){
                // 「\d」は半角数字の0〜9を表します。
                // 「\d{2,4}」は「\d」が2〜4個続く事を表します。
                // 「\d{4}」は「\d」が4個続く事を表します。
                if(!value.match(/^\d{3}\d{3,4}\d{4}$/)){
                    this.nextBtnAppearrance = false   
                } else {
                    this.nextBtnAppearrance = true
                }
            },
            time(){
                let passiveState = this.$store.state.status.prevState
                if (passiveState) {
                    this.$emit('prevStep')
                } else {
                    this.$emit('nextStep')
                }
            }
        }

    }
</script>
<style lang="scss" scoped>
@import '../../../sass/variables';
.tell-container{
    .input-container{
        p{
            font-size: 40px;
        }
        .input-area{
            .input{
                input{
                    width: 100%;
                    height: 80px;
                    font-size: 40px;
                }
            }
        }
    }
    .num-button-container{
        width: 50%;
        .num-button-area{
            .button-back{
                height: 100px;
            }
            .input-btn{
                height: 100px;
            }
            .clear-btn{
                width: 186%;
            }
            .clear-button-back{
                width: 186%;
            }

        }
    }
}
.link-area{
    display: flex;
    justify-content: space-around;
    .btn-container{
        width: 25%;
        position: relative;
        font-size: 35px;
        .button-back{
            width: 80%;
            height: 90px;
        }
        .next-btn{
            width: 80%;
            height: 90px;
            line-height: 90px;
        }
        .skip-btn{
            height: 90px;
            width: 80%;
            line-height: 90px;
            background: #dcdcdc;
            color: #232323;
            border: 0.5px solid #808080;
        }
        .skip-button-back{
            background: #696969;
        }
        .waiting-btn{
            width: 80%;
            height: 90px;
            line-height: 90px;
        }

    }
}
.prev-btn-container{
    top: 110%;
    left: -8%;
}

@media screen and (max-width: 1024px) {
    .form-container{
        margin-top: 0;
        .flex-container{
            .input-container{
                margin-right: 0;
                p{
                    margin-bottom: 5px;
                    font-size: 28px;
                }
                .input-area{
                    .input{
                        input{
                            width: 120%;
                            height: 60px;
                            font-size: 30px;
                        }
                    }
                }
            }
            .num-button-container{
                .num-button-area{
                    .button-back{          
                        height: 80px;
                    }    
                    .input-btn{
                        height: 80px;
                    }
                }
            }

        }
    }
    .link-area{
        .btn-container{
            .button-back{
                width: 100%;
                height: 70px;
                top: 7px;
            }
            .next-btn{
                width: 100%;
                height: 70px;
                line-height: 70px;
                font-size: 25px;
            }
            .waiting-btn{
                width: 100%;
                height: 70px;
            }

            .skip-btn{
                height: 70px;
                width: 100%;
                line-height: 70px;
                background: #f5f5f5;
                color: #232323;
                font-size: 25px;
                border: 0.5px solid #808080;
            }
            .skip-button-back{
                background: #696969;
            }
        }
    }

}
</style>