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
                        <font-awesome-icon icon="angle-left" style="width: 40px; height: 40px;" />
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
                time: 0,
                classSwitch: null,
                selectSeatType: null,
                seatTypes: ['テーブル席', 'ボックス席', 'カウンター席', 'どこでも可']
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
            nextStep(seatType){
                this.classSwitch    = 'reactive'
                this.selectSeatType = seatType
                this.$emit('getSelectSeatType', seatType)
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
            border: 0.5px solid #808080;
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