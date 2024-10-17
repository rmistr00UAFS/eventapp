<script setup lang="ts">
import { watch, ref, computed } from 'vue'
import { date } from '../functions/date'
import { saveEvent } from '../functions/saveEvent'
import { getSavedEvents } from '../functions/getSavedEvents'
import { getAllEventsByDay } from '../functions/getAllEventsByDay'
import { getCats } from '../functions/getCats'

import Cats from '../components/cats.vue'
import { globalState } from '../functions/data.js'

let userid = localStorage.getItem('userid')

let eventsSavedByUser = ref([])
if (userid) {
  getSavedEvents(userid)
    .then((events) => {
      let ids = []
      events.events?.forEach((x) => {
        ids.push(x.EVENTID)
      })
      eventsSavedByUser.value = ids
      console.log(eventsSavedByUser)
    })
    .catch((error) => {
      console.error('Error fetching saved events:', error)
    })
}

let selectedDay = ref()

let filteredEvents = ref()
let getTodayDate = () => {
  const today = new Date()
  selectedDay.value = today.toISOString().split('T')[0]
  getAllEventsByDay(selectedDay.value).then((res) => {
    filteredEvents.value = res.events
  })
}
getTodayDate()
</script>

<template>
  <main>
    <div class="eventsContainer">
      All events for today
      <input type="date" class="date" value="date" v-model="selectedDay" @input="selectDate()" />

      <Cats />

      <div class="allEvents">
        <div
          :id="'event-' + event.EVENTID"
          v-for="event in filteredEvents"
          :key="event.EVENTID"
          @click="recenter(event)"
          class="event"
          :class="{ selectedEvent: selectedEvent === event.EVENTID }"
        >
          <!-- Individual divs for each event property with their own class -->
          <div class="title">{{ event.TITLE }}</div>
          <div class="location">{{ event.LOCATION }}</div>
          <div class="description">{{ event.INFO }}</div>
          <div class="time">{{ event.TIME }}</div>
          <div class="address">{{ event.ADDRESS }}</div>

          <span
            v-show="globalState.auth"
            class="material-icons md-48 bookmarkEvent"
            @click="saveEventForUser(userid, event.EVENTID)"
            :style="{ color: savedEvents.includes(event.EVENTID) ? 'var(--green)' : 'black' }"
          >
            bookmark
          </span>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.todaysEvents {
  margin: 20px;
}
.date {
  background: var(--theme);
  border: none;
  outline: none;
  color: white;
  padding: 10px;
  border-radius: 20px;
  box-shadow: var(--shadow);
  font-size: 20px;
  position: absolute;
  top: 10px;
  right: 10px;
}

.eventsContainer {
  font-size: 25px;
  box-shadow: var(--shadow);
  padding: 10px;
  border-radius: 20px;
  width: 500px;
  position: fixed;
  z-index: 10;
  background: var(--light);
  left: 20px;
  top: 100px;
  bottom: 20px;
}
.allEvents {
  font-size: 15px;
  height: calc(100% - 120px);
  overflow: scroll;
  margin: 10px 0;
  margin-top: 30px;
  box-shadow: var(--inset-shadow);
  border-radius: 20px;
}

.event {
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 10px;
  border-radius: 5px;
  position: relative;
}
.event .title {
  font-weight: bold;
  font-size: 20px;
}
.bookmarkEvent {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}

.today {
  text-align: center;
  font-size: 20px;
}

.selectedEvent {
  background: var(--theme);
  color: white;
  transition: 0.3s;
}
</style>
