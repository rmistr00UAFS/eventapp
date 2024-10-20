<script setup lang="ts">
import { ref } from 'vue'

import { globalState } from '../functions/data.js'
import Login from './LoginView.vue'
import CreatedEvents from '../components/CreatedEvents.vue'
import EventForm from '../components/EventForm.vue'
import { submitEvent } from '../functions/writeFunctions.js'

let newEvent = ref(false)
let submit = () => {
  submitEvent()
  newEvent.value = false
}
</script>

<template>
  <div v-if="!globalState.auth">
    <Login />
  </div>
  <div v-if="globalState.auth">
    <div class="create-event">
      <EventForm v-if="newEvent" />
      <div v-if="newEvent">
        <button class="submit-button" @click="submit">submit Event</button>
      </div>
      <button class="creator" @click="newEvent = true" v-if="!newEvent">Create</button>
      <button class="cancel-button" @click="newEvent = fasle" v-if="newEvent">cancel</button>
    </div>
    <CreatedEvents />
  </div>
</template>

<style scoped></style>
