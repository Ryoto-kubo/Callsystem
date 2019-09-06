<template>
    <!-- <div>
        <div class="form-container">
            <form id="post_form">
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
    </div> -->
<div>
    <header-component :propsTitle="title" />
    <div class="progressbar-container">
        <div class="progressbar" :style="{left: moveBarPercent + '%'}"></div>
        <div class="progressbar-back js-progressbar"></div>
    </div>

    <div v-if="nextStepId === 1">
        <form-input-peoples-component
            :propsPrevTrigger="prevTrigger"
            @nextStep="nextStep"
            @getPeopleNum="getPeopleNum"
            @progressBarMove="progressBarMove"
            @progressBarMoveReset="progressBarMoveReset"/>
    </div>

    <div v-else-if="nextStepId === 2">
        <form-seat-select-component
            :propsPrevStepState="prevStepState"
            @nextStep="nextStep"
            @prevStep="prevStep"
            @getSelectSeatType="getSelectSeatType"
            @progressBarMove="progressBarMove"
            @progressBarMoveReset="progressBarMoveReset"
            />
    </div>
    
    <div v-else-if="nextStepId === 3">
        <form-tobacco-select-component
            @nextStep="nextStep"
            @prevStep="prevStep"
            @getSelectTobaccoType="getSelectTobaccoType"
            @progressBarMove="progressBarMove"
            @progressBarMoveReset="progressBarMoveReset"
            />
    </div>

    <!-- <div v-else-if="nextStepId === 4">
        <form-seat-select-component
            v-if="nextStepId === 4"/>
    </div> -->

</div>

</template>
<script>
import { constants } from 'crypto';
    export default {
        data() {
            return {
                moveBarPercent: '',
                nextStepId: '',
                title: '',
                peopleNum: null,
                selectSeat: null,
                selectTobacco: null,
                prevTrigger: null,
                prevStepState: null,
            }
        },
        mounted() {
            this.nextStepId = 1
        },
        methods: {
            nextStep: function(nextStepId){
                this.nextStepId = nextStepId
            },
            prevStep(prevStepId, prevComponentName, prevStepState){
                this.prevTrigger   = true
                this.prevStepState = prevStepState
                this.nextStepId    = prevStepId
                this.progressBarMoveReset(prevComponentName)
            },
            progressBarMove: function(componentName){
                const INPUT_PEOPLES  = 'inputPeoples'
                const SELECT_SEAT    = 'selectSeat'
                const SELECT_TOBACCO = 'selectTobacco'
                if(componentName == INPUT_PEOPLES){
                    this.moveBarPercent = -75
                } else if (componentName == SELECT_SEAT){
                    this.moveBarPercent = -50
                } else if (componentName == SELECT_TOBACCO){
                    this.moveBarPercent = -25
                }
            },
            progressBarMoveReset: function(componentName){
                const INPUT_PEOPLES = 'inputPeoples'
                const SELECT_SEAT   = 'selectSeat'
                if(componentName == INPUT_PEOPLES){
                    this.moveBarPercent = -100
                } else if (componentName == SELECT_SEAT){
                    this.moveBarPercent = -75
                }
            },
            getPeopleNum(inputPeopleNum){
                this.peopleNum = inputPeopleNum
            },
            getSelectSeatType(selectSeat){
                this.selectSeat = selectSeat
            },
            getSelectTobaccoType(tobaccoType){
                this.selectTobacco = tobaccoType
            }
        },
        watch: {
            nextStepId: function(){
                if(this.nextStepId === 1){
                    this.title = '人数を入力してください'
                }else if(this.nextStepId === 2){
                    this.title = '希望の座席を選択してください'
                }else if(this.nextStepId === 3){
                    this.title = '喫煙席又は禁煙席を選択してください'
                }
            }
        }
    }

</script>
<style>
</style>