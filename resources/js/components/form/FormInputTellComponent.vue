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
                <div class="flex-container">
                    <div class="num-button-container">
                        <div class="tell-num-button-area" v-for="item in nums" :key="item.index">
                            <div class="button-back next-btn"></div>
                            <button v-if="numBtnAppearrance" class="btn tell-num-btn" @click="numInput(item)" onfocus="this.blur();">{{ item }}</button>
                            <button v-else class="btn tell-num-btn gray" onfocus="this.blur();">{{ item }}</button>
                        </div>
                        <div class="tell-num-button-area">
                            <div class="button-back clear-button-back next-btn"></div>
                            <button class="btn tell-num-btn clear-btn" type="button" @click="numClear" onfocus="this.blur();">←</button>
                        </div>
                    </div>
                </div>
                <div class="prev-btn-container">
                    <div class="prev-btn-area">
                        <div class="prev-button-back"></div>
                        <button class="prev-btn" type="button" onfocus="this.blur();" @click="prevStep">
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
                isActive: true,
                active: 'active',
                reActive: 'reactive',
                prevActive: 'prev-active',
                prevReActive: 'prev-reactive',
                prevTrigger: false,
                selectTobaccoType: null,
                nums: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-'],
            }
        },
        mounted() {
            // this.isActive = true
            this.prevDelayTime = 0
            this.nextDelayTime = 0
        },
        computed: {
            classSwitch: function(){
                if(this.prevTrigger){
                    this.isActive = false
                    return this.prevReActive
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
            nextStep: function(tobaccoType){
                this.isActive = false
                this.selectTobaccoType = tobaccoType
                this.$emit('getSelectTobaccoType', tobaccoType)

                let componentName = 'selectTobacco'
                this.$emit('progressBarMove', componentName)
                
                setTimeout(() => {this.nextDelayTime++ }, 1000)

            },
            prevStep: function(){
                this.prevTrigger = true
                setTimeout(() => {this.prevDelayTime++ }, 1000)
            }
        },
        watch: {
            prevDelayTime: function(){
                let prevComponentName = 'selectSeat'
                let prevStepState = true
                let prevStepId = 2
                this.$emit('prevStep', prevStepId, prevComponentName, prevStepState)
            },
            nextDelayTime: function(){
                let nextStepId = 4
                this.$emit('nextStep', nextStepId)
            }
        }

    }
</script>