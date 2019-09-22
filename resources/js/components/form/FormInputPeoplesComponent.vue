<template>
<div>
    <div class="form-container" :class="classSwitch">
        <div class="flex-container">
            <div class="input-container">
                <div class="input-area">
                    <div class="input">
                        <input id="num-input" v-model="inputPeopleObject.peopleNum" type="num" readonly="readonly">
                    </div>
                    <div class="group-text">
                        <p>名様</p>
                    </div>
                </div>
            </div>
            <div class="num-button-container">
                <div class="num-button-area" v-for="item in nums" :key="item.index">
                    <div class="button-back next-btn"></div>
                    <button v-if="numBtnAppearrance" class="btn input-btn" @click="numInput(item)" onfocus="this.blur();">{{ item }}</button>
                    <button v-else class="btn input-btn gray" onfocus="this.blur();">{{ item }}</button>
                </div>
                <div class="num-button-area">
                    <div class="button-back clear-button-back next-btn"></div>
                    <button class="btn input-btn clear-btn" type="button" @click="numClear" onfocus="this.blur();">クリア</button>
                </div>
            </div>
        </div>
        <div v-if="nextBtnAppearrance" class="link-area">
            <div v-if="propsEditStatus">
                <div class="button-back background-blue"></div>
                <button id="js-next-btn" class="btn next-btn ripple" onfocus="this.blur();" @click="openModal" style="padding: 0;">登録</button>
            </div>
            <div v-else>
                <div class="button-back background-blue"></div>
                <button id="js-next-btn" class="btn next-btn ripple" onfocus="this.blur();" @click="nextStep" style="padding: 0;">次へ</button>
            </div>
        </div>
        <div v-else class="link-area">
            <div class="button-back" style="background: #8b0000;"></div>
            <button class="btn waiting-btn ripple" onfocus="this.blur();"></button>
        </div>
    </div>
    <modal-component v-if="modalActive" @close="closeModal"/>
</div>
</template>

<script>
import { finished } from 'stream';
import { setTimeout } from 'timers';
import { mapGetters } from 'vuex'
    export default {
        data() {
            return {
                inputPeopleObject: {
                    id: this.currentId,
                    peopleNum: '',
                },
                time: 0,
                modalActive: false,
                classSwitch: null,
                nextBtnAppearrance: false,
                numBtnAppearrance: true,
                number: null,
                nums: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
            }
        },
        props: {
            currentId: Number,
            propsEditStatus: Boolean,
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
        },
        methods: {
            openModal(){
                this.$store.dispatch('app/inputPeopleNum', { inputPeopleObject: this.inputPeopleObject})
                this.modalActive = true
            },
            closeModal(){
                this.modalActive = false
            },
            numInput(item){
                this.inputPeopleObject.peopleNum += item
            },
            numClear(){
                this.inputPeopleObject.peopleNum = ''
            },
            nextStep(){
                this.classSwitch = 'reactive'
                this.$store.dispatch('status/nextStep', { currentId: this.currentId })
                this.$store.dispatch('app/inputPeopleNum', { inputPeopleObject: this.inputPeopleObject})
                this.$emit('getPeopleNum', this.peopleNum)
                setTimeout(() => {this.time++ }, 1000)
            }
        },
        watch: {
            'inputPeopleObject.peopleNum'(){
                if(this.inputPeopleObject.peopleNum.length <= 2){
                    this.nextBtnAppearrance = true
                    this.$emit('progressBarMove', this.currentId)
                    if(this.inputPeopleObject.peopleNum.length === 2){
                        this.numBtnAppearrance = false
                    }else if(this.inputPeopleObject.peopleNum.length === 0){
                        this.nextBtnAppearrance = false
                        this.numBtnAppearrance  = true
                        this.$emit('progressBarMoveReset')
                    }
                }
            },
            time(){
                this.$emit('nextStep')
            }
        }
    }
</script>
<style lang="scss" scoped>
@import '../../../sass/variables';

.input{
    input{
        width: 350px;
        height: 170px;
        text-align: center;
        border: 5px solid #707070;
        border-radius: 20px;
        font-size: 70px;
        color: #696969;
    }
}
.group-text{
    margin-left: 10px;
    font-size: 30px;
    p{
        margin: 0;
    }
}

.num-button-container{
    width: 50%;
    .num-button-area{
        &:nth-child(11){
            margin-right: 0;
        }
        .clear-btn{
            width: 186%;
        }
        .clear-button-back{
            width: 186%;
        }
    }
}
@media screen and (max-width: 1024px) {

    .form-container{
        .flex-container{
            .input-container{
                width: 111.55%;
            }
        }
    }

}
</style>