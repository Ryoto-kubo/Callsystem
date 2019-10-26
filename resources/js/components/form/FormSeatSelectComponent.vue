<template>
    <div>
        <div class="form-container" :class="classSwitch">
            <div class="flex-container seat-flex">
                <div class="seat-btn-container" v-for="seatType in seatTypes" :key="seatType.index">
                    <div class="button-back seat-btn-back"></div>
                    <button class="btn seat-btn" onfocus="this.blur();" @click="nextStep(seatType.id)">{{seatType.seat}}</button>
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
        <template v-if="modalActive || thanksModalActive">
            <transition name="thanks" appear>
                <div :class="toggleOverlay" @click="closeModal"></div>
            </transition>
        </template>

        <template v-if="modalActive">
            <modal-component 
                @close="closeModal"
                @progressBarMove="progressBarMove"
                @thanksModalOpen="thanksModalOpen" />
        </template>

        <template v-if="thanksModalActive">
            <thanks-component />
        </template>
    </div>
</template>
<script>
import { constants } from 'crypto';
    export default {
        data() {
            return {
                selectSeatOject: {
                    id: this.currentId,
                    selectSeatType: null,
                },
                time: 0,
                modalActive: false,
                thanksModalActive: false,
                classSwitch: null,
                seatTypes: [
                    {id: 1, seat: 'テーブル席'},
                    {id: 2, seat: 'ボックス席'},
                    {id: 3, seat: 'カウンター席'},
                    {id: 4, seat: 'どこでも可'},
                ]
            }
        },
        props: {
            currentId: Number,
            propsEditStatus: Boolean
        },
        computed: {
            toggleOverlay:function(){
                return{
                    'overlay' : this.modalActive || this.thanksModalActive,
                }
            }
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
            nextStep(seatTypeId){
                this.selectSeatOject.selectSeatType = seatTypeId
                this.$store.dispatch('app/inputSeatType', { selectSeatOject: this.selectSeatOject })
                if (this.propsEditStatus) {
                    this.modalActive = true
                } else {
                    this.classSwitch = 'reactive'
                    this.$store.dispatch('status/nextStep', { currentId: this.currentId })
                    this.$emit('progressBarMove', this.currentId)
                    setTimeout(() => {this.time++ }, 1000)
                }
            },
            prevStep(){
                this.$store.dispatch('status/prevForm', { prevState: true })
                this.classSwitch = 'prev-reactive'
                this.$emit('progressBarMove', this.currentId)
                this.$store.dispatch('status/prevStep', { currentId: this.currentId })
                setTimeout(() => {this.time++ }, 1000)
            },
            closeModal(){
                this.modalActive = false
            },
            thanksModalOpen(){
                this.modalActive       = false
                this.thanksModalActive = true
            },
            progressBarMove(lastId){
                this.$emit('progressBarMove', lastId)
            }
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
.overlay {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 30;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.thanks-enter-active, .thanks-leave-active {
  transition: opacity 0.6s;

  .overlay {
    transition: opacity 0.6s, transform 0.6s;
  }
}

.thanks-leave-active {
  transition: opacity 0.8s ease 0.6s;
}

.thanks-enter, .thanks-leave-to {
  opacity: 0;

  .overlay {
    opacity: 0;
    transform: translateY(150px);
  }
}

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
            color: #707070;
            background: #fafafa;
            border-radius: 10px;
            font-size: 40px;
            outline: none;
            border: 0.5px solid #c0c0c0;
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