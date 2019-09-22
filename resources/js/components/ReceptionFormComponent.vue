<template>
<div>
    <header-component :propsTitle="title" />
    <div class="progressbar-container">
        <div class="progressbar" :style="{left: moveBarPercent + '%'}"></div>
        <div class="progressbar-back js-progressbar"></div>
    </div>

    <div v-if="nextStepId === 1">
        <form-input-peoples-component
            :currentId="nextStepId"
            :propsEditStatus='editStatus'
            @nextStep="nextStep"
            @progressBarMove="progressBarMove"
            @progressBarMoveReset="progressBarMoveReset"/>
    </div>

    <div v-else-if="nextStepId === 2">
        <form-seat-select-component
            :currentId="nextStepId"
            :propsEditStatus='editStatus'
            @nextStep="nextStep"
            @prevStep="prevStep"
            @progressBarMove="progressBarMove"
            />
    </div>
    
    <div v-else-if="nextStepId === 3">
        <form-tobacco-select-component
            :currentId="nextStepId"
            :propsEditStatus='editStatus'
            @nextStep="nextStep"
            @prevStep="prevStep"
            @progressBarMove="progressBarMove"
            />
    </div>

    <div v-else-if="nextStepId === 4">
        <form-input-tell-component
            :currentId="nextStepId"
            @nextStep="nextStep"
            @prevStep="prevStep"
            @progressBarMove="progressBarMove"
            />
    </div>
</div>

</template>
<script>
import { constants } from 'crypto';
    export default {
        data() {
            return {
                editStatus: false,
                moveBarPercent: '',
                nextStepId: '',
                title: '',
            }
        },
        computed: {
            getEditStatus() {
                return this.$store.state.status.editStatus
            }
        },
        mounted() {
            this.nextStepId = 1
        },
        methods: {
            nextStep(){
                this.nextStepId = this.$store.state.status.nextStepId
            },
            prevStep(){
                this.nextStepId = this.$store.state.status.prevStepId
            },
            progressBarMove(currentId){
                const entiretyNum          = -100
                let entiretyComponentCount = 4
                let divisionNum            = entiretyNum / entiretyComponentCount
                let passiveState           = this.$store.state.status.prevState
                if (!passiveState) {
                    this.moveBarPercent = entiretyNum - divisionNum * currentId
                } else {
                    this.moveBarPercent = this.moveBarPercent + divisionNum
                }
            },
            progressBarMoveReset(){
                this.moveBarPercent = -100
            },
        },
        watch: {
            nextStepId(){
                if (this.nextStepId === 1){
                    this.title = '人数を入力してください'
                } else if (this.nextStepId === 2){
                    this.title = '希望の座席を選択してください'
                } else if (this.nextStepId === 3){
                    this.title = '喫煙席又は禁煙席を選択してください'
                } else if (this.nextStepId === 4){
                    this.title = '電話番号でのお呼び出しも可能です'
                }
            },
            getEditStatus: {
                handler: function (editObject) {
                    this.nextStepId = editObject.id
                    this.editStatus = editObject.editPrev
                },
                deep: true
            }
        }
    }

</script>
<style lang="scss" scoped>
@import '../../sass/variables';
.progressbar-container{
    width: 95%;
    margin: auto;
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    .progressbar{
        width: 100%;
        height: 15px;
        left: -100%;
        background: linear-gradient(-90deg, $btn_color, #1e90ff);
        position: absolute;
        transition: all .8s ease-in-out;
    }
    .move{
        left: 0;
        transition: all .8s ease-in-out;
    }
    .progressbar-back{
        width: 100%;
        background: #808080;
    }
}
</style>