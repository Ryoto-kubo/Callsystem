<template>
    <div class="form-container" :class="classSwitch">
        <div class="flex-container tell-container">
            <div class="input-container">
                <div>
                    <p>※任意</p>
                </div>
                <div class="input-area">
                    <div class="input">
                        <input id="num-input" v-model="tellNum" type="num" readonly="readonly">
                    </div>
                </div>
            </div>
            <div class="num-button-container">
                <div class="num-button-area" v-for="item in nums" :key="item.index">
                    <div class="button-back"></div>
                    <button class="btn input-btn" @click="tellNumInput(item)" onfocus="this.blur();">{{ item }}</button>
                </div>
                <div class="num-button-area">
                    <div class="button-back"></div>
                    <button class="btn input-btn" type="button" @click="numClear" onfocus="this.blur();">←</button>
                </div>
            </div>
        </div>
        <div class="link-area">
            <div class="button-back skip-button-back"></div>
            <button class="btn skip-btn" onfocus="this.blur();">スキップ</button>
            <div class="button-back background-blue"></div>
            <button id="js-next-btn" class="btn next-btn ripple" onfocus="this.blur();" @click="nextStep" style="padding: 0;">確認</button>
        </div>
        <div class="prev-btn-container">
            <div class="prev-btn-area">
                <div class="prev-button-back"></div>
                <button class="prev-btn" type="button" onfocus="this.blur();" @click="prevStep">
                    <font-awesome-icon icon="angle-left" style="width: 40px; height: 40px;" />前に戻る
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
                prevDelayTime: 0,
                nextDelayTime: 0,
                isActive: true,
                active: 'active',
                reActive: 'reactive',
                prevActive: 'prev-active',
                prevReActive: 'prev-reactive',
                nextBtnAppearrance: true,
                prevTrigger: false,
                selectTobaccoType: null,
                nums: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-'],
            }
        },
        mounted() {
            // this.isActive = true
            this.prevDelayTime = 0
            this.nextDelayTime = 0
        },
        computed: {
            classSwitch: function(){
                if(this.prevTrigger){
                    this.isActive = false
                    return this.prevReActive
                } else if(!this.prevTrigger){
                    if(this.isActive){
                        return this.active
                    }else{
                        return this.reActive
                    }
                }
            }
        },
        methods: {
            tellNumInput: function(item){
                this.tellNum += item
            },
            numClear: function(){
                this.tellNum = ''
            },
            nextStep: function(tobaccoType){
                this.isActive = false
                this.selectTobaccoType = tobaccoType
                this.$emit('getSelectTobaccoType', tobaccoType)

                let componentName = 'selectTobacco'
                this.$emit('progressBarMove', componentName)
                
                setTimeout(() => {this.nextDelayTime++ }, 1000)

            },
            prevStep: function(){
                this.prevTrigger = true
                setTimeout(() => {this.prevDelayTime++ }, 1000)
            }
        },
        watch: {
            prevDelayTime: function(){
                let prevComponentName = 'selectSeat'
                let prevStepState = true
                let prevStepId = 2
                this.$emit('prevStep', prevStepId, prevComponentName, prevStepState)
            },
            nextDelayTime: function(){
                let nextStepId = 4
                this.$emit('nextStep', nextStepId)
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
                    height: 100px;
                    font-size: 60px;
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
        }
    }
}
.link-area{
    .button-back{
        width: 25%;
        height: 90px;
        left: 68.6%;
    }
    .next-btn{
        width: 25%;
        height: 90px;
        line-height: 90px;
    }
    .skip-btn{
        height: 90px;
        width: 25%;
        margin-right: 130px;
        line-height: 90px;
        background: #dcdcdc;
        color: #232323;
        border: 0.5px solid #808080;
    }
    .skip-button-back{
        left: 31.4%;
        background: #696969;
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
                p{
                    font-size: 30px;
                }
                .input-area{
                    .input{
                        input{
                            width: 90%;
                            height: 70px;
                            font-size: 40px;
                        }
                    }
                }
            }
            .num-button-container{
                width: 70%;
                .num-button-area{
                    &:nth-child(n+1):nth-child(-n+9){
                        margin-bottom: 10px;
                    }
                    .button-back{
                        height: 75px;
                        top: 13px;
                    }
                    .input-btn{
                        height: 75px;
                    }
                }
            }
        }
    }
    .link-area{
        .button-back{
            width: 22%;
            height: 70px;
            top: 7px;
            left: 67.3%;
        }
        .next-btn{
            width: 22%;
            height: 70px;
            line-height: 70px;
            font-size: 30px;
        }
        .skip-btn{
            height: 70px;
            width: 22%;
            margin-right: 100px;
            font-size: 30px;
            line-height: 70px;
            background: #f5f5f5;
            color: #232323;
            border: 0.5px solid #808080;
        }
        .skip-button-back{
            left: 32.7%;
            background: #696969;
        }
    }
    // .prev-btn-container{
    //     .prev-btn-area{
    //         .prev-button-back{
    //             height: 60px;
    //         }
    //         .prev-btn{
    //             height: 60px;
    //             font-size: 25px;
    //         }
    //     }
    // }


}
</style>