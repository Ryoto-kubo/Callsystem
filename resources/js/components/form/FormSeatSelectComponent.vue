<template>
    <div class="form-container" :class="[isActive ? active : reactive]">
        <h1 style="color: #000000;">座席を選択してくれよな！！！</h1>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                time: 0,
                isActive: '',
                active: 'active',
                reactive: 'reactive',
                nextBtnAppearrance: false,
                numBtnAppearrance: true,
            }
        },
        mounted() {
            this.isActive = true
            this.time = 0
        },

    }
</script>
