<template>
<span>
    {{nums.reception_data_min}}
</span>
</template>

<script>
export default {
    data() {
        return {
            time: 0,
            nums: [],
        }
    },
    created() {
        setInterval(() => {this.time++}, 1000),
        axios.get('/reception/min').then(response => this.nums = response.data);
    },
    watch: {
        time: function(countup){
            if(countup % 2 == 0){
                axios.get('/reception/min').then(response => this.nums = response.data);
            }
        }
    }
}
</script>
