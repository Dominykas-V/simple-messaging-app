<template>
    <div>
        <h2>VUE TEST</h2>
        <button @click="counter++">COUNTER: {{ counter }}</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            counter: 0,
        }
    }
}
</script>

<style>

</style>