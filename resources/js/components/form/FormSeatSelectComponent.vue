<template>
    <div>
        <div class="form-container" :class="classSwitch">
            <div class="flex-container seat-flex">
                <div class="seat-btn-container" v-for="seatType in seatTypes" :key="seatType.index">
                    <div class="button-back seat-btn-back"></div>
                    <button class="btn seat-btn" onfocus="this.blur();" @click="nextStep(seatType)">{{seatType}}</button>
                </div>
            </div>
            <div class="prev-btn-container">
                <div class="prev-btn-area">
                    <div class="prev-button-back"></div>
                    <button class="btn prev-btn" type="button" onfocus="this.blur();" @click="prevStep">
                        <font-awesome-icon icon="angle-left" style="width: 40px; height: 40px;" />前に戻る
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                prevDelayTime: 0,
                nextDelayTime: 0,
                active: 'active',
                reActive: 'reactive',
                prevActive: 'prev-active',
                prevReActive: 'prev-reactive',
                isActive: true,
                prevTrigger: false,
                prevStepState: this.propsPrevStepState,
                selectSeatType: null,
                seatTypes: ['テーブル席', 'ボックス席', 'カウンター席', 'どこでも可']
            }
        },
        props: {
            propsPrevStepState: '',
        },
        mounted() {
            // this.isActive = true
            this.prevDelayTime = 0
            this.nextDelayTime = 0
        },
        computed: {
            classSwitch: function(){
                if(this.prevStepState){ // 前の画面から戻ってきたかどうかの判断
                    return this.prevActive

                } else if (this.prevTrigger){ // 今の画面から前の画面に戻るかどうかの判断
                    this.isActive = false
                    return this.prevReActive

                } else if (!this.prevTrigger){ // 
                    if(this.isActive){
                        return this.active

                    }else{
                        return this.reActive

                    }
                }
            }
        },
        methods: {
            nextStep: function(seatType){
                this.isActive       = false
                this.prevStepState  = false
                this.selectSeatType = seatType
                this.$emit('getSelectSeatType', seatType)

                let componentName = 'selectSeat'
                this.$emit('progressBarMove', componentName)
                
                setTimeout(() => {this.nextDelayTime++ }, 1000)

            },
            prevStep: function(){
                this.prevTrigger   = true
                this.prevStepState = false
                setTimeout(() => {this.prevDelayTime++ }, 1000)
            }
        },
        watch: {
            prevDelayTime: function(){
                let prevComponentName = 'inputPeoples'
                let prevStepId = 1
                this.$emit('prevStep', prevStepId, prevComponentName)
            },
            nextDelayTime: function(){
                let nextStepId = 3
                this.$emit('nextStep', nextStepId)
            }
        }

    }
</script>
<style lang="scss" scoped>
@import '../../../sass/variables';

.seat-flex{
    flex-wrap: wrap;
    .seat-btn-container{
        width: 48%;
        margin-bottom: 60px;
        text-align: center;
        position: relative;
        .seat-btn{
            width: 80%;
            height: 200px;
            color: #232323;
            background: #f5f5f5;
            border-radius: 10px;
            font-size: 40px;
            outline: none;
        }
        .seat-btn-back{
            width: 80%;
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
    left: -6%;
}

@media screen and (max-width: 1024px) {

    .seat-flex{
        .seat-btn-container{
            .seat-btn{
                width: 80%;
                height: 150px;
                font-size: 32px;
            }
            .seat-btn-back{
                width: 80%;
                height: 150px;
            }
        }
    }
    .prev-btn-container{
        left: -7%;
    }
}
</style>