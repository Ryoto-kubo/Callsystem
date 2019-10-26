<template>
<div>
    {{nums.reception_data_count}}
</div>
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
        axios.get('/api/reception/count')
        .then(response => {
            this.nums = response.data
        })
        .catch(error => {
            console.log(error)
        })
    },
    watch: {
        time: function(countup){
            if(countup % 2 == 0){
                axios.get('/api/reception/count')
                .then(response => {
                    this.nums = response.data
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>
