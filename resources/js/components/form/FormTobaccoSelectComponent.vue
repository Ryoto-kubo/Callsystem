<template>
    <div>
        <div class="form-container" :class="classSwitch">
            <div class="flex-container tobacco-flex">
                <div class="tobacco-btn-container" v-for="tobaccoType in tobaccoTypes" :key="tobaccoType.index">
                    <div class="button-back tobacco-btn-back"></div>
                    <button class="btn tobacco-btn" onfocus="this.blur();" @click="nextStep(tobaccoType)">{{tobaccoType}}</button>
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
                tobaccoTypes: ['禁煙席', '喫煙席', 'どちらでも可']
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
<style>
.tobacco-flex{
    flex-wrap: wrap;
}
.tobacco-btn-container{
    width: 48%;
    margin-bottom: 60px;
    text-align: center;
    position: relative;
}
.tobacco-btn{
    width: 90%;
    height: 200px;
    color: #232323;
    background: #f5f5f5;
    border-radius: 10px;
    font-size: 40px;
    outline: none;
}
.tobacco-btn-back{
    width: 90%;
    height: 200px;
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translate(-50%, 0);
    z-index: -1;
    border-radius: 10px;
    background: #696969;
}
.prev-btn-container{
    width: 87%;
    margin: auto;
    position: absolute;
    top: 120%;
    left: -5%;
}
.prev-btn-area{
    width: 23%;
    position: relative;
    display: flex;
    align-items: center;
}
.prev-btn{
    width: 100%;
    height: 85px;
    background: #f5f5f5;
    position: absolute;
    top: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: .1s all ease;
    color: #232323;
    font-size: 32px;
    z-index: 1;
    border-radius: 10px;
}
.prev-btn:active{
    top: 5px;
}
.prev-button-back{
    width: 100%;
    height: 85px;
    position: absolute;
    top: 8px;
    background: #696969;
    border-radius: 10px;
}


@media screen and (max-width: 1024px) {

.tobacco-btn{
    width: 80%;
    height: 150px;
    font-size: 32px;
}
.tobacco-btn:active{
    top: 5px;
}
.button-back{
    width: 80%;
    height: 150px;
}
.prev-btn-container{
    width: 85%;
    top: 105%;
    left: -7%;
}
.prev-btn{
    height: 70px;
    font-size: 25px;
}
.prev-button-back{
    height: 70px;
}
}
</style>