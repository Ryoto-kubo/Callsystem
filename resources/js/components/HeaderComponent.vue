<template>
    <header>
        <div class="header-container">
            <div class="page-description">
                {{ propsTitle }}
            </div>
            <div class="img-container">
                <a href="/"><img src="/images/home.png" width="75px" height="75px" alt="home"></a>
            </div>
        </div>
    </header>
</template>

<script>
import { maxHeaderSize } from 'http';
export default {
    props: {
        propsTitle: ''
    }
}
</script>

<style>

</style>