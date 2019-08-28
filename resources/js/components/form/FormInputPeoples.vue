<template>
    <div class="form-container">
       <div class="input-container">
           <div class="input-area">
               <div class="input">
                   <input type="text" v-model="peopleNum">
               </div>
               <div class="group-text">
                   <p>名様</p>
               </div>
           </div>
       </div>
       <div class="num-button-container">
           <div class="num-button-area" v-for="item in nums" :key="item.index">
                <button class="num-btn" type="button">{{ item }}</button>
            </div>
       </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                peopleNum: null,
                nums: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'クリア']
        
            }
        }
    }
</script>
