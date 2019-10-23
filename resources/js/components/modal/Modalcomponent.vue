<template>
    <transition name="modal" appear>
        <div class="modal modal-overlay" @click.self="$emit('close')">
            <div class="modal-window">
                <div class="modal-content">
                    <div class="confirm-container">
                        <div class="confirm-text-container">
                            <!-- <div class="confirm-text">人数:{{peopleObject.peopleNum}}名</div> -->
                            <div class="confirm-text">
                                <div class="content-text">
                                    <font-awesome-icon class="title-icon" icon="users"/>
                                    {{peopleObject.peopleNum}}名
                                </div>
                            </div>
                            <div class="icon-container">
                                <font-awesome-icon class="edit-icon" icon="edit" @click="editPrev(peopleObject.id)"/>
                            </div>
                            <!-- <div class="confirm-text">2名</div> -->
                        </div>
                        <div class="confirm-text-container">
                            <div class="confirm-text">
                                <div class="content-text">
                                    <font-awesome-icon class="title-icon" icon="chair"/>
                                    {{displaySeat}}
                                </div>
                            </div>
                            <div class="icon-container">
                                <font-awesome-icon class="edit-icon" icon="edit" @click="editPrev(seatTypeObject.id)"/>
                            </div>
                            <!-- <div class="confirm-text">ボックス席</div> -->
                        </div>
                        <div class="confirm-text-container">
                            <div class="confirm-text">
                                <font-awesome-icon class="title-icon" icon="smoking"/>
                                {{displayTobacco}}
                            </div>
                            <div class="icon-container">
                                <font-awesome-icon class="edit-icon" icon="edit" @click="editPrev(tobaccoTypeObject.id)"/>
                            </div>
                            <!-- <div class="confirm-text">禁煙席</div> -->
                        </div>
                        <div class="confirm-text-container">
                            <div class="confirm-text">
                                <font-awesome-icon class="title-icon" icon="phone"/>
                                {{displayTell}}
                            </div>
                            <div class="icon-container">
                                <font-awesome-icon class="edit-icon" icon="edit" @click="editPrev(inputTellNumObject.id)"/>
                            </div>
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
                            <button class="btn next-btn ripple" onfocus="this.blur();" @click="postData" style="padding: 0;">登録</button>
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
            editStatus: {
                id: null,
                editPrev: false
            },
            peopleObject: null,
            seatTypeObject: null,
            tobaccoTypeObject: null,
            inputTellNumObject: null,
            displaySeat: null,
            displayTobacco: null,
            displayTell: '未入力です',
            time: 0,
        }
    },
    created() {
        this.peopleObject       = this.$store.state.app.inputPeopleObject
        this.seatTypeObject     = this.$store.state.app.selectSeatOject
        this.tobaccoTypeObject  = this.$store.state.app.selectTobaccoObject
        this.inputTellNumObject = this.$store.state.app.inputTellNumObject

        this.idConvertSeatText(this.seatTypeObject.selectSeatType)
        this.idConvertTobaccoText(this.tobaccoTypeObject.selectTobaccoType)
        this.stateConvertTellText(this.inputTellNumObject.inputState)
    },
    methods: {
        postData(){
            let request_array = {}
            request_array['peoples']     = this.peopleObject.peopleNum
            request_array['seat_id']     = this.seatTypeObject.selectSeatType
            request_array['smoke_id']    = this.tobaccoTypeObject.selectTobaccoType
            request_array['tell_number'] = this.inputTellNumObject.tellNum

            setTimeout(() => {
                this.time++
                axios.post('reception/formpost', request_array)
                .then(function(response){
                        console.log(response)
                    }
                )
                .catch(function(error){
                        console.log(erroe)
                    }
                )
            }, 200)
        },
        closeModal(){
            setTimeout(() => {
                this.time++
            }, 100)
        },
        editPrev(value){
            this.editStatus.id       = value
            this.editStatus.editPrev = true
            this.$store.dispatch('status/editStatus', { editStatus: this.editStatus})
        },
        idConvertSeatText(seatId){
            switch (seatId) {
                case 1:
                    this.displaySeat = 'テーブル席'
                    break;
                case 2:
                    this.displaySeat = 'ボックス席'
                    break;
                case 3:
                    this.displaySeat = 'カウンター席'
                    break;
                case 4:
                    this.displaySeat = 'どこでも可'
                    break;
                default:
            }
        },
        idConvertTobaccoText(tobaccoId){
            switch (tobaccoId) {
                case 1:
                    this.displayTobacco = '禁煙席'
                    break;
                case 2:
                    this.displayTobacco = '喫煙席'
                    break;
                case 3:
                    this.displayTobacco = 'どちらでも可'
                    break;
                default:
            }
        },
        stateConvertTellText(boolean){
            if (boolean){
                this.displayTell = this.inputTellNumObject.tellNum
            }
        }
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

    .modal-window {
        width: 70%;
        height: 700px;
        border-radius: 10px;
        background: #fff;
        overflow: hidden;
        position: relative;
    }

    .modal-content {
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
                border-bottom: 2px solid #dcdcdc;
                display: flex;
                    justify-content: space-between;
                align-items: flex-end;
                .icon-container{
                    margin-right: 10px;
                    .edit-icon{
                        width: 50px;
                        height: 35px;
                        margin-bottom: 5px;
                        color: #1e90ff;
                    }
                }
                .confirm-text{
                    margin-left: 10px;
                    font-size: 30px;
                    color: #707070;
                    .title-icon{
                        width: 50px;
                        height: 35px;
                        margin-right: 10px;
                    }
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