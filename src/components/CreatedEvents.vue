<script setup lang="ts">
import { globalState } from '../functions/data.js'
import { timeConvert, getCatName } from '../functions/f.js'
import { getCreatedEvents } from '../functions/readFunctions.js'
import { deleteCreatedEvent } from '../functions/deleteFunctions.js'
import { updateCreatedEvent } from '../functions/writeFunctions.js'

import { ref } from 'vue'

import EventForm from './EventForm.vue'

getCreatedEvents()

let selectedEvent = ref()

let editForm = (eventid) => {
  selectedEvent.value = eventid
  let event = {}
  let data = globalState.createdEvents.find((x) => x.EVENTID === eventid)

  for (const key in data) {
    event[key.toLowerCase()] = data[key]
  }

  globalState.selectedCat = 'Conference'

  globalState.event = event
}
let cancel = () => {
  selectedEvent.value = null
}
let update = (eventid) => {
  updateCreatedEvent(eventid)
  selectedEvent.value = null
}
</script>

<template>
  <div class="createdEvents">
    <div class="events">
      <div class="events-title">Your created events</div>
      <div class="eventsContainer">
        <div
          v-for="event in globalState.createdEvents"
          :key="event.EVENTID"
          :id="event.EVENTID"
          class="event"
          :class="{ selectedEvent: selectedEvent === event.EVENTID }"
        >
          <div v-if="selectedEvent !== event.EVENTID">
            <div class="title">{{ event.TITLE }}</div>
            <div class="location">{{ event.LOCATION }}</div>
            <div class="description">{{ event.INFO }}</div>
            <div class="date">DATE: {{ event.DATE }}</div>

            <div class="time">TIME: {{ event.TIME }}</div>
            <div class="address">{{ event.ADDRESS }}</div>
          </div>

          <EventForm v-if="selectedEvent === event.EVENTID" />
          <button class="cancel-button" @click="cancel" v-if="selectedEvent === event.EVENTID">
            cancel
          </button>

          <button
            v-if="selectedEvent === event.EVENTID"
            class="update-button"
            @click="update(event.EVENTID)"
          >
            update Event
          </button>

          <button
            v-if="selectedEvent !== event.EVENTID"
            class="edit-button"
            @click="editForm(event.EVENTID)"
          >
            edit
          </button>
          <button
            v-if="selectedEvent === event.EVENTID"
            class="delete-button"
            @click="deleteCreatedEvent(event.EVENTID)"
          >
            delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.createdEvents {
  padding: 20px;
}
.event {
  display: inline-block;
  width: 200px;
  box-shadow: var(--shadow);
}
.selectedEvent {
  background: var(--theme);
  color: white;
  transition: 0.3s;
}
</style>
