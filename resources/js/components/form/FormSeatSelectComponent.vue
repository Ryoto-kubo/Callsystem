<template>
    <div class="form-container" :class="[isActive ? active : reactive]">
        <div class="flex-container seat-flex">
            <div class="seat-btn-container" v-for="seat in seatTypes" :key="seat.index">
                <div class="button-back seat-btn-back"></div>
                <button class="btn seat-btn" onfocus="this.blur();" @click="nextStep(seat)">{{seat}}</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                time: 0,
                isActive: true,
                active: 'active',
                reactive: 'reactive',
                seatTypes: ['テーブル席', 'ボックス席', 'カウンター席', 'どこでも可']
            }
        },
        mounted() {
            // this.isActive = true
            this.time = 0
        },
        methods: {
            nextStep: function(seat){
                this.$emit('getSelectSeat', seat)

                let componentName = 'selectSeat'
                this.$emit('progressBarMove', componentName)

                // let nextStepId = 3
                // this.$emit('nextStep', nextStepId)
            }
        }

    }
</script>
<style>
.seat-flex{
    flex-wrap: wrap;
}
.seat-btn-container{
    width: 48%;
    margin-bottom: 60px;
    text-align: center;
    position: relative;
}
.seat-btn{
    width: 90%;
    height: 200px;
    color: #232323;
    background: #f5f5f5;
    border-radius: 10px;
    font-size: 40px;
    outline: none;
}
.seat-btn-back{
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

@media screen and (max-width: 1024px) {

.seat-btn{
    width: 80%;
    height: 150px;
    font-size: 32px;
}

.seat-btn:active{
    top: 5px;
}
.button-back{
    width: 80%;
    height: 150px;
}

}
</style>