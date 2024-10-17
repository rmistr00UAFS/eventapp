

<script setup lang="ts">
let testFunction1 = function () {
  console.log('test1')
}

let testFunction2 = () => {
  console.log('test2')
}

testFunction2()
</script>

<template><button class="test_button" @click="testFunction1">Test</button></template>

<style scoped>
.test_button {
  background: red;
}
</style>
