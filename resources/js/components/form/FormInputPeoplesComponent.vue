<template>
<div class="form-container" :class="classSwitch">
    <div class="flex-container">
        <div class="input-container">
            <div class="input-area">
                <div class="input">
                    <input id="num-input" v-model="peopleNum" type="num" readonly="readonly">
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
        <div class="button-back background-blue"></div>
        <button id="js-next-btn" class="btn next-btn ripple" onfocus="this.blur();" @click="nextStep" style="padding: 0;">次へ</button>
    </div>
    <div v-else class="link-area">
        <div class="button-back" style="background: #8b0000;"></div>
        <button class="btn waiting-btn ripple" onfocus="this.blur();"></button>
    </div>
</div>
</template>

<script>
import { finished } from 'stream';
import { setTimeout } from 'timers';
    export default {
        data() {
            return {
                peopleNum: '',
                time: 0,
                isActive: true,
                prevTrigger: this.propsPrevTrigger,
                active: 'active',
                reActive: 'reactive',
                prevActive: 'prev-active',
                nextBtnAppearrance: false,
                numBtnAppearrance: true,
                number: null,
                nums: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
            }
        },
        props: {
            propsPrevTrigger: '',
        },
        mounted() {
            // this.isActive = true
            this.time = 0
        },
        computed: {
            classSwitch: function(){
                if(this.prevTrigger){
                    this.isActive = false
                    return this.prevActive
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
            numInput: function(item){
                this.peopleNum += item
            },
            numClear: function(){
                this.peopleNum = ''
            },
            nextStep: function(){
                this.isActive    = false
                this.prevTrigger = false
                this.$emit('getPeopleNum', this.peopleNum)
                setTimeout(() => {this.time++ }, 1000)
            }
        },
        watch: {
            peopleNum: function(){
                let componentName = 'inputPeoples'
                if(this.peopleNum.length <= 2){
                    this.nextBtnAppearrance = true
                    this.$emit('progressBarMove', componentName)
                    if(this.peopleNum.length === 2){
                        this.numBtnAppearrance = false
                        this.$emit('progressBarMove', componentName)
                    }else if(this.peopleNum.length === 0){
                        this.nextBtnAppearrance = false
                        this.numBtnAppearrance  = true
                        this.$emit('progressBarMoveReset', componentName)
                    }
                }
            },
            time: function(){
                let nextStepId = 2
                this.$emit('nextStep', nextStepId)
            }
        }
    }
</script>
