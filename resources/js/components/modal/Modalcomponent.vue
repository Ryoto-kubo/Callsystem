<template>
    <transition name="modal" appear>
        <div class="modal modal-overlay" @click.self="$emit('close')">
            <div class="modal-window">
                <div class="modal-content">
                    <div class="confirm-container">
                        <div class="confirm-text-container">
                            <div class="icon-container">
                                <font-awesome-icon icon="edit" style="width: 50px; height: 50px; margin-bottom: 3px;" @click="editPrev(peopleObject.id)"/>
                            </div>
                            <div class="confirm-text">{{peopleObject.peopleNum}}名</div>
                            <!-- <div class="confirm-text">2名</div> -->
                        </div>
                        <div class="confirm-text-container">
                            <div class="icon-container">
                                <font-awesome-icon icon="edit" style="width: 50px; height: 50px; margin-bottom: 3px;" @click="editPrev(seatTypeObject.id)"/>
                            </div>
                            <div class="confirm-text">{{seatTypeObject.selectSeatType}}</div>
                            <!-- <div class="confirm-text">ボックス席</div> -->
                        </div>
                        <div class="confirm-text-container">
                            <div class="icon-container">
                                <font-awesome-icon icon="edit" style="width: 50px; height: 50px; margin-bottom: 3px;" @click="editPrev(3)"/>
                            </div>
                            <div class="confirm-text">{{selectTobaccoObject.selectTobaccoType}}</div>
                            <!-- <div class="confirm-text">禁煙席</div> -->
                        </div>
                        <div class="confirm-text-container">
                            <div class="icon-container">
                                <font-awesome-icon icon="edit" style="width: 50px; height: 50px; margin-bottom: 3px;" @click="editPrev(4)"/>
                            </div>
                            <div class="confirm-text">{{tellNum}}</div>
                            <!-- <div class="confirm-text">09012345678</div> -->
                        </div>
                    </div>
                    <div class="btn-container">
                        <div class="btn-area">
                            <div class="button-back" style="background: #8b0000;"></div>
                            <button class="btn close-btn ripple" onfocus="this.blur();" @click="closeModal" style="padding: 0;">とじる</button>
                        </div>
                        <div class="btn-area">
                            <div class="button-back background-blue"></div>
                            <button class="btn next-btn ripple" onfocus="this.blur();" @click="nextStep" style="padding: 0;">登録</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            peopleObject: null,
            seatTypeObject: null,
            selectTobaccoObject: null,
            tellNum: null,
            time: 0,
        }
    },
    created() {
        this.peopleObject        = this.$store.state.app.inputPeopleObject
        this.seatTypeObject      = this.$store.state.app.selectSeatOject
        this.selectTobaccoObject = this.$store.state.app.selectTobaccoObject
        this.tellNum     = this.$store.state.app.tellNum
    },
    methods: {
        nextStep(){
            console.log('hello')
        },
        closeModal(){
            setTimeout(() => {this.time++ }, 100)
        },
        editPrev(value){
            console.log(value)
        },
    },
    watch: {
        time(){
            this.$emit('close')
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables';

.modal {
    &.modal-overlay {
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

    &-window {
        width: 70%;
        height: 700px;
        border-radius: 10px;
        background: #fff;
        overflow: hidden;
        position: relative;
    }

    &-content {
        width: 70%;
        margin: auto;
        border: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        .confirm-container{
            margin-bottom: 30px;
            .confirm-text-container{
                margin-bottom: 30px;
                padding-left: 10px;
                border-bottom: 2px solid #dcdcdc;
                display: flex;
                align-items: flex-end;
                .icon-container{
                    margin-right: 30px;
                }
                .confirm-text{
                    font-size: 30px;
                    color: #232323;
                }
            }
        }
        .btn-container{
            display: flex;
            justify-content: space-between;
            .btn-area{
                width: 100%;
                position: relative;
                text-align: center;
                .btn{
                    position: relative;
                    height: 70px;
                    margin: auto;
                    line-height: 70px;
                    font-size: 30px;
                    color: #ffffff;
                }
                .button-back{
                    width: 69.9%;
                    height: 70px;
                    margin: auto;
                    position: absolute;
                    top: 8px;
                    left: 50%;
                    transform: translate(-50%, 0);
                    border-radius: 10px;
                }
                .background-blue{
                    background: #008b8b;
                }
                .next-btn{
                    width: 70%;
                    background: $btn_color;
                }
                .close-btn{
                    width: 70%;
                    background: #f08080;
                }
            }
        }  
    }
}

.modal-enter-active, .modal-leave-active {
  transition: opacity 0.6s;

  .modal-window {
    transition: opacity 0.6s, transform 0.6s;
  }
}

.modal-leave-active {
  transition: opacity 0.8s ease 0.6s;
}

.modal-enter, .modal-leave-to {
  opacity: 0;

  .modal-window {
    opacity: 0;
    transform: translateY(150px);
  }
}
</style>