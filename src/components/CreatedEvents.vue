<script setup lang="ts">
import { globalState } from '../functions/data.js'
import { timeConvert, getCatName } from '../functions/f.js'
import { getCreatedEvents } from '../functions/readFunctions.js'

getCreatedEvents()

let editForm = (eventid) => {
  console.log(eventid)
}
</script>

<template>
  <div class="createdEvents">
    <div class="events">
      <div class="events-title">Your created events</div>
      <div class="eventsContainer">
        <div v-for="event in globalState.createdEvents" :key="event.EVENTID" class="event">
          <div class="title">{{ event.TITLE }}</div>
          <div class="location">{{ event.LOCATION }}</div>
          <div class="description">{{ event.INFO }}</div>
          <div class="date">DATE: {{ event.DATE }}</div>

          <div class="time">TIME: {{ event.TIME }}</div>
          <div class="address">{{ event.ADDRESS }}</div>

          <button class="edit-button" @click="editForm(event.EVENTID)">edit</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
