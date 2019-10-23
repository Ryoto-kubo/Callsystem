<template>
    <div>
        <div class="form-container" :class="classSwitch">
            <div class="flex-container tobacco-flex">
                <div class="tobacco-btn-container" v-for="tobaccoType in tobaccoTypes" :key="tobaccoType.index">
                    <div class="button-back tobacco-btn-back"></div>
                    <button class="btn tobacco-btn" onfocus="this.blur();" @click="nextStep(tobaccoType.id)">{{tobaccoType.tobacco}}</button>
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
        <modal-component v-if="modalActive" @close="closeModal"/>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                selectTobaccoObject: {
                    id: this.currentId,
                    selectTobaccoType: null
                },
                time: 0,
                modalActive: false,
                classSwitch: null,
                tobaccoTypes: [
                    {id: 1, tobacco: '禁煙席'},
                    {id: 2, tobacco: '喫煙席'},
                    {id: 3, tobacco: 'どちらでも可'},
                ]
            }
        },
        props: {
            currentId: Number,
            propsEditStatus: Boolean
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
            nextStep(tobaccoTypeId){
                this.selectTobaccoObject.selectTobaccoType = tobaccoTypeId
                this.$store.dispatch('app/inputTobaccoType', { selectTobaccoObject: this.selectTobaccoObject })
                if (this.propsEditStatus) {
                    this.modalActive = true
                } else {
                    this.classSwitch                           = 'reactive'
                    this.$store.dispatch('status/nextStep', { currentId: this.currentId })
                    this.$emit('progressBarMove', this.currentId)
                    setTimeout(() => {this.time++ }, 1000)
                }
            },
            prevStep(){
                this.$store.dispatch('status/prevForm', { prevState: true });
                this.classSwitch = 'prev-reactive'
                this.$emit('progressBarMove', this.currentId)
                this.$store.dispatch('status/prevStep', { currentId: this.currentId });
                setTimeout(() => {this.time++ }, 1000)
            },
            closeModal(){
                this.modalActive = false
            },
        },
        watch: {
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
<style lang='scss' scoped>
@import '../../../sass/variables';

.tobacco-flex {
    flex-wrap: wrap;
    .tobacco-btn-container{
        width: 33%;
        margin-bottom: 60px;
        text-align: center;
        position: relative;
        .tobacco-btn{
            width: 90%;
            height: 200px;
            color: #707070;
            background: #fafafa;
            border-radius: 10px;
            font-size: 40px;
            outline: none;
            border: 0.5px solid #c0c0c0;
        }
        .tobacco-btn-back{
            width: 90%;
            height: 200px;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: -1;
            border-radius: 10px;
            background: #696969;
        }
    }
}
.prev-btn-container{
    top: 190%;
    left: -6%;
}

@media screen and (max-width: 1024px) {

    .tobacco-flex{
        .tobacco-btn-container{
            .tobacco-btn{
                width: 80%;
                height: 150px;
                font-size: 30px;
            }
            .button-back{
                width: 80%;
                height: 150px;
            }
        }
    }
    .prev-btn-container{
        top: 160%;
        left: -7%;
    }

}
</style>