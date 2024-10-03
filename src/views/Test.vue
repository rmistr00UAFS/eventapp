<script setup lang="ts">
import { ref } from 'vue'
const test = ref({})

const getData = () => {
  fetch('http://localhost/getEvents.php')
    .then((response) => response.json())
    .then((data) => {
      console.log(data)
      test.value = data

      console.log(test)
    })
    .catch((error) => {
      console.log(error)
    })
}

//get data
getData()
</script>

<template>
  TESTING AREA
  <!--
  <div v-for="user in test" :key="user.id" class="user">
        {{ user.USERID }}
      </div>-->

  kim
</template>

<style scoped></style>
