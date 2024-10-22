<script setup lang="ts">
import { globalState } from '../functions/data.js'
import Login from './LoginView.vue'
import CreatedEvents from '../components/CreatedEvents.vue'
</script>

<template>
  <div v-if="!globalState.auth">
    <Login />
  </div>
  <div v-if="globalState.auth">
    <CreatedEvents />
  </div>
</template>

<style scoped></style>
