<template>
    <div>
        <div class="form-container">
            <form id="post_form">
                <!-- @csrf -->
                <input v-model="params.token" type="hidden" name="_token">
                <div class="error-msg">
                    <span v-show="errors.peoples">{{errors.peoples}}</span>
                </div>
                <div class="entry-area">
                    <div class="title">人数<span style="color:red;">（必須）</span></div>
                    <div>
                        <div>
                            <label for="peoples">
                                <input v-model="params.peoples" id="peoples" type="number" name="peoples" placeholder="人数">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="error-msg">
                    <span class="js-error-msg-seat_id"></span>
                </div>
                <div class="entry-area">
                    <div class="title">座席</div>
                    <label for="seat">
                        <select v-model="params.seat_id" id="seat" name="seat_id">
                            <option value=1>テーブル席</option>
                            <option value=2>ボックス席</option>
                            <option value=3>カウンター席</option>
                            <option value=4>どこでも可</option>
                        </select>
                    </label>
                </div>

                <div class="error-msg">
                    <span class="js-error-msg-smoke_id"></span>
                </div>
                <div class="entry-area">
                    <div class="title">タバコ</div>
                    <div>
                        <div>
                            <label>
                                <input v-model="params.smoke_id" id="smoke" name="smoke_id" type="radio" value=1>喫煙席
                            </label>
                        </div>
                        <div>
                            <label>
                                <input v-model="params.smoke_id" id="smoke" name="smoke_id" type="radio" value=2>禁煙席
                            </label>
                        </div>
                        <div>
                            <label>
                                <input v-model="params.smoke_id" id="smoke" name="smoke_id" type="radio" value=3>どちらでも可
                            </label>
                        </div>
                    </div>
                </div>

                <div class="error-msg">
                    <span v-show="errors.tell_number">{{errors.tell_number}}</span>
                </div>
                <div class="entry-area">
                    <div class="title">電話番号</div>
                    <div>
                        <div>
                            <label for="tell">
                                <input v-model="params.tell_number" id="tell" type="text" name="tell_number" placeholder="000-0000-0000（任意）">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="btn-container">
                    <button @click="validate" id="form-submit" type="button">確認</button>
                </div>
            </form>
        </div>
        <transition v-if="showModal" name="modal" appear>
            <div id="overlay">
                <div class="modal-container">
                    <div class="post-confirm-container">
                        <div class="confirm-contents">
                            <div class="confirm-tiile">人数：</div><div class="confirm-content">{{display.peoples}}</div>
                        </div>
                        <div class="confirm-contents">
                            <div class="confirm-tiile">座席：</div><div class="confirm-content">{{display.seat}}</div>
                        </div>
                        <div class="confirm-contents">
                            <div class="confirm-tiile">タバコ：</div><div class="confirm-content">{{display.smoke}}</div>
                        </div>
                        <div class="confirm-contents">
                            <div class="confirm-tiile">電話番号：</div><div class="confirm-content">{{display.tell_number}}</div>
                        </div>
                    </div>
                    <div class="btn-container">
                        <button @click="closeModal" form="post_form" id="form-submit" type="submit">送信</button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { constants } from 'crypto';
    export default {
        data() {
            const DEFAULT_ID = 1;
            return {
                showModal: false,
                params: {
                    peoples: null,
                    seat_id: DEFAULT_ID,
                    smoke_id: DEFAULT_ID,
                    tell_number: null,
                    token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                display: {
                    peoples: null,
                    seat: null,
                    smoke: null,
                    tell_number: null
                },
                errors: {
                    peoples: '',
                    tell_number: ''
                }
            }
        },
        methods: {
            openModal: function(){
                this.pramsOnDisplayCast(this.params)
                this.showModal = true;
            },
            closeModal: function(){
                event.preventDefault();
                if(this.params.seat_id == 'テーブル席'){
                    this.params.seat_id = 1
                }

                this.showModal = false;
                axios.post('/reception/formpost', this.params)
                .then(function(response){
                    window.location.href = "/";
                }).catch(function(error){
                    console.log(error)
                });
            },
            validate: function(){
                axios.post('/reception/validate', this.params)
                .then(function(response){
                    if(response.data.success){
                        this.openModal()
                    }else{
                        this.errors.peoples     = response.data.messages.peoples
                        this.errors.tell_number = response.data.messages.tell_number
                    }
                }.bind(this))
                .catch(function(error){
                    console.log(error)
                }.bind(this));
            },
            pramsOnDisplayCast: function(params){
                this.display.peoples = params.peoples
                this.display.tell_number = params.tell_number

                let seat_id  = Number(params.seat_id)
                    if(seat_id === 1){
                        this.display.seat = 'テーブル席'
                    }else if(seat_id === 2){
                        this.display.seat = 'ボックス席'
                    }else if(seat_id === 3){
                        this.display.seat = 'カウンター席'
                    }else if(seat_id === 4){
                        this.display.seat = 'どこでも可'
                    }

                let smoke_id  = Number(params.smoke_id)
                    if(smoke_id === 1){
                        this.display.smoke = '喫煙席'
                    }else if(smoke_id === 2){
                        this.display.smoke = '禁煙席'
                    }else if(smoke_id === 3){
                        this.display.smoke = 'どちらでも可'
                    }
            }
        }

    }
</script>

<style>
.modal-container{
    width: 500px;
    height: 300px;
    z-index:2;
    padding: 1em;
    background:#fff;
    border-radius: 20px;
}

.post-confirm-container{
    width: 60%;
    margin: auto;
    text-align: center;
}

.confirm-contents{
    margin-bottom: 20px;
    display: flex;
    border-bottom: 1px solid #000;
}

.confirm-tiile{
    width: 100px;
    margin-right: 30px;
    font-size: 20px;
    text-align: left;
}

.confirm-content{
    font-size: 20px;
}

#overlay{
    /*　要素を重ねた時の順番　*/
    z-index:1;

    /*　画面全体を覆う設定　*/
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:rgba(0,0,0,0.5);

    /*　画面の中央に要素を表示させる設定　*/
    display: flex;
    align-items: center;
    justify-content: center;

}
</style>