<script setup lang="ts">
import { globalState } from '../functions/data.js'
import { timeConvert, getCatName } from '../functions/f.js'
import { getCreatedEvents } from '../functions/readFunctions.js'
import { deleteCreatedEvent } from '../functions/deleteFunctions.js'
import { updateCreatedEvent, submitEvent } from '../functions/writeFunctions.js'
import { date } from '../functions/date.js'

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

  globalState.event = event
}
let deleteButton = () => {
  deleteCreatedEvent(selectedEvent.value)
  selectedEvent.value = null
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
  <div class="creator">
    <div class="events-title">created events</div>

    <div class="create-event">
      <EventForm />

      <button v-if="!selectedEvent" class="submit-button" @click="submitEvent">create Event</button>

      <div class="selected-event-buttons" v-if="selectedEvent">
        <button class="update-button" @click="update(selectedEvent)">update Event</button>
        <button class="delete-button" @click="deleteButton">delete</button>
        <button class="cancel-button" @click="cancel">cancel</button>
      </div>
    </div>

    <div class="created-events">
      <img v-if="!globalState.createdEvents" class="cover-img" src="/create.svg" />

      <div class="eventsContainer">
        <div
          v-for="event in globalState.createdEvents"
          :key="event.EVENTID"
          :id="event.EVENTID"
          class="event"
          :class="{ selectedEvent: selectedEvent === event.EVENTID }"
        >
          <div class="title">{{ event.TITLE }}</div>
          <div class="location">{{ event.LOCATION }}</div>
          <div class="description">{{ event.INFO }}</div>

          <div class="category" v-if="event.CATEGORYID !== 0">
            <span class="material-icons md-48"> info </span>

            {{ getCatName(event.CATEGORYID) }}
          </div>
          <div class="date">
            <span class="material-icons md-48"> event </span>

            {{ date(event.DATE) }}
          </div>
          <div class="time">
            <span class="material-icons md-48"> schedule </span>

            {{ timeConvert(event.TIME) }}
          </div>
          <div class="address">
            <span class="material-icons md-48"> public </span>

            {{ event.ADDRESS }}
          </div>
          <button
            v-if="selectedEvent !== event.EVENTID"
            class="edit-button"
            @click="editForm(event.EVENTID)"
          >
            edit
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.events-title {
  color: white;
  font-size: 30px;
  text-transform: uppercase;
}
.creator {
  background: var(--theme);

  height: 100vh;
}
.created-events {
  background: var(--light);

  padding: 20px;
  position: absolute;
  left: 380px;
  top: 100px;
  width: calc(100% - 440px);
  box-shadow: var(--inset-shadow);
  height: calc(100% - 160px);
  overflow: scroll;
}
.event {
  display: inline-block;
  width: 200px;
  box-shadow: var(--shadow);
}

.create-event {
  transition: 0.3s;
  width: 300px;
  background: white;
  border-radius: 20px;
  box-shadow: var(--shadow);
  padding: 20px;
  position: absolute;
  top: 100px;
  left: 20px;
}
.event {
  width: 300px;
  min-height: 300px;
  background: white;
  border: 1px solid black;
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 20px;
  border-radius: 20px;
  position: relative;
  display: inline-table;
}

.description,
.category,
.date,
.time,
.address {
  padding: 5px;
  font-size: 20px;
}
.edit-button {
  margin-top: 15px;
  font-size: 18px;
  background-color: var(--blue);
  position: absolute;
  bottom: 10px;
  right: 10px;
}
.title {
  /*   color: var(--theme); */
  font-size: 23px;
  padding: 3px;
}

.selectedEvent {
  background: var(--theme);
  color: white;
  transition: 0.3s;
}
.description {
  min-height: 50px;
  max-height: 50px;
  overflow: scroll;
  box-shadow: var(--inset-shadow);
  padding: 10px;
  margin: 10px 0 10px 0;
}
button {
  margin-top: 10px;
  margin-right: 10px;
}
.delete-button {
  background: var(--red);
}
.cancel-button {
  color: black;
  background: var(--yellow);
}
</style>
