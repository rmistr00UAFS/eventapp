<script setup lang="ts">
import { globalState } from '../functions/data.js'

import Cats from './cats.vue'
</script>

<template>
  <div class="eventForm">
    Choose Category
    <Cats />
    <div>
      <label for="title">title</label>
      <input
        id="title"
        v-model="globalState.event.title"
        type="text"
        placeholder="Enter event title"
      />

      <label for="date">Date</label>
      <input id="date" v-model="globalState.event.date" type="date" />

      <label for="time">Time</label>
      <input id="time" v-model="globalState.event.time" type="time" />

      <label for="info">Info</label>
      <textarea
        id="info"
        v-model="globalState.event.info"
        placeholder="Enter event information"
      ></textarea>

      <label for="address">Address</label>
      <input
        id="address"
        v-model="globalState.event.address"
        type="text"
        placeholder="Enter event address"
      />
    </div>
  </div>
</template>

<style scoped>
input {
  border-radius: 10px;
  font-size: 20px;
}
textarea {
  font-size: 20px;
}
label {
  display: block;
  margin: 10px 0 10px 0;
  text-transform: uppercase;
}
#info {
  height: 200px;
  border-radius: 20px;
  padding: 10px;
  width: 250px;
  resize: none;
}
</style>
