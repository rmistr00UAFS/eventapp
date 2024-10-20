<script setup lang="ts">
import { globalState } from '../functions/data.js'
import SavedEvents from '../components/SavedEvents.vue'
import Login from './LoginView.vue'
</script>

<template>
  <div v-if="!globalState.auth">
    <Login />
  </div>
  <div v-if="globalState.auth">
    <SavedEvents />
  </div>
</template>

<style scoped></style>
