<script setup lang="ts">
import { getUserDetails } from '../functions/readFunctions.js'
import { ref } from 'vue'
let user = ref()

getUserDetails().then((data) => {
  user.value = data
  console.log(user)
})
</script>

<template>
  <div class="username">
    {{ user?.FIRSTNAME }}
    {{ user?.LASTNAME }}
  </div>
</template>

<style scoped>
.username {
  position: absolute;
  right: 20px;
  top: 90px;
  font-size: 20px;
  color: white;
  text-transform: uppercase;
}
</style>
