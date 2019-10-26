<template>
    <transition name="modal" appear>
        <!-- <div class="modal" @click.self="$emit('close')"> -->
        <div class="modal modal-overlay">
            <div class="modal-window">
                <div class="modal-content">
                    <div class="reception-container">
                        <div class="thanks-container">
                            <p class="thanks-text">ありがとうございます</p>
                            <p class="thanks-text">受付番号は</p>
                        </div>
                        <div class="reception-number-container">
                             <div class="reception-number-text">
                                 {{receptionNumber.reception_data_count}}
                            </div>
                            <div class="reception-after-text">番です</div>
                        </div>
                        <p class="reception-last-text">
                            少々お待ちください
                        </p>
                    </div>
                    <div class="btn-container">
                        <div class="btn-area">
                            <div class="button-back background-gray"></div>
                            <button class="btn next-btn ripple" onfocus="this.blur();" @click="prevHome" style="padding: 0;">
                                <img src="/images/home.png" width="50px" height="50px" alt="home">
                                ホームへ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    data() {
        return {
            receptionNumber: {}
        }
    },
    created() {
        axios.get('/reception/count').then(response => this.receptionNumber = response.data);
    },
    methods: {
        prevHome(){
            setTimeout(() => {
                location.href = '/'
            },200)
        }
    },
    watch: {
    }
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables';

.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 30;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
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
        .reception-container{
            text-align: center;
            .thanks-container{
                .thanks-text{
                    font-size: 30px;
                }
            }
            .reception-number-container{
                margin-bottom: 30px;
                display: flex;
                justify-content: center;
                align-items: flex-end;
                line-height: 1;
                .reception-number-text{
                    margin-right: 10px;
                    font-size: 120px;
                    font-weight: bold;
                    color: $number_color;
                }
                .reception-after-text{
                    font-size: 24px;
                    line-height: 2.4;
                }
            }
            .reception-last-text{
                font-size: 30px;
            }
        }
        .btn-container{
            display: flex;
            justify-content: space-between;
            .btn-area{
                width: 100%;
                position: relative;
                text-align: center;
                img{
                    display: block;
                    margin: auto;
                    margin-bottom: 5px;
                }
                .btn{
                    position: relative;
                    height: 90px;
                    margin: auto;
                    line-height: 25px;
                    font-size: 30px;
                    color: #707070;
                    border: 0.5px solid #c0c0c0;
                }
                .button-back{
                    width: 50%;
                    height: 90px;
                    margin: auto;
                    position: absolute;
                    top: 8px;
                    left: 50%;
                    transform: translate(-50%, 0);
                    border-radius: 10px;
                }
                .background-gray{
                    background: #696969;
                }
                .next-btn{
                    width: 50%;
                    background: #fafafa;
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

@media screen and (max-width: 1024px) {
    .modal {
        .modal-window {
            height: 600px;
        }
        .modal-content {
            .btn-container{
                .btn-area{
                    text-align: center;
                    .btn{
                        height: 90px;
                        line-height: 25px;
                        font-size: 24px;
                    }
                    .button-back{
                        height: 90px;
                        border-radius: 10px;
                    }
                }
            }  
        }
    }
}

</style>