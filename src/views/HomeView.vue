<script setup lang="ts">
import { watch, ref, computed } from 'vue'
import { GoogleMap, Marker, CustomMarker, InfoWindow } from 'vue3-google-map'
import { saveEvent } from '../functions/saveEvent'
import { getSavedEvents } from '../functions/getSavedEvents'
import { getAllEventsByDay } from '../functions/getAllEventsByDay'
import { getCats } from '../functions/getCats'

import Cats from '../components/cats.vue'
import { globalState } from '../functions/data.js'

import attenders from '../components/attenders.vue'

import { getAllAttenders } from '../functions/getAllAttenders'

let center = ref({ lat: 35.385803, lng: -94.403229 })
let recenter = (event) => {
  center.value = event.COORDINATES
  selectedEvent.value = event.EVENTID

  const eventElement = document.getElementById(`event-${event.EVENTID}`)
  if (eventElement) {
    eventElement.scrollIntoView({ behavior: 'smooth', block: 'center' }) // Smooth scrolling to the event
  } else {
    console.error(`Event with ID ${event.EVENTID} not found`) // Log if event is not found
  }
}

let selectedEvent = ref()

let filteredEvents = ref()

watch(globalState, (newValue, oldValue) => {
  let cat = newValue.selectedCat?.CA_ID

  if (cat) {
    filteredEvents.value = events.value.filter((event) => event.CATEGORYID == cat)
  } else {
    filteredEvents.value = events.value
  }
})
let events = ref()
let userid = localStorage.getItem('userid')

let selectedDay = ref()

let selectDate = () => {
  console.log(selectedDay)
  getAllEventsByDay(selectedDay.value).then((res) => {
    events.value = res.events
    filteredEvents.value = res.events
    globalState.selectedCat = null
  })
}

let getTodayDate = () => {
  const today = new Date()
  today.setMinutes(today.getMinutes() - today.getTimezoneOffset())
  selectedDay.value = today.toISOString().split('T')[0]

  getAllEventsByDay(selectedDay.value).then((res) => {
    events.value = res.events
    filteredEvents.value = res.events
  })
}
getTodayDate()

let savedEvents = ref([])

getSavedEvents(userid)
  .then((events) => {
    let ids = []
    events.events?.forEach((x) => {
      ids.push(x.EVENTID)
    })
    savedEvents.value = ids
  })
  .catch((error) => {
    console.error('Error fetching saved events:', error)
  })

async function saveEventForUser(userid, eventid) {
  // Check if the eventid already exists in savedEvents.value
  if (!savedEvents.value.includes(eventid)) {
    // Only push the eventid if it's not already in the array
    savedEvents.value.push(eventid)
    await saveEvent(userid, eventid)
  } else {
    console.log(`Event ${eventid} is already saved for this user.`)
  }
}

let enableMap = ref(true)

let getAtt = (eventid) => {
  let count = ref(0)
  getAllAttenders(eventid).then((data) => {
    let n = data.attendees?.length

    if (n) {
      count.value = n
    }
  })
  return count
}

let timeConvert = (time) => {
  const [hours, minutes, seconds] = time.split(':')
  const date = new Date()
  date.setHours(hours, minutes, seconds)

  return date
    .toLocaleTimeString('en-US', {
      hour: 'numeric',
      minute: 'numeric',
      hour12: true
    })
    .toUpperCase() // Convert to "AM" or "PM"
}

let getCatName = (id) => {
  const cat = globalState.cats.find((x) => x.CA_ID == id)
  return cat ? cat.NAME : '?'
}
</script>

<template>
  <main>
    <div class="eventsContainer">
      <div class="allEventsTitle">Today's events</div>
      <input type="date" class="date" value="date" v-model="selectedDay" @input="selectDate()" />
      Filter by Category

      <Cats />

      <div class="allEvents">
        <div class="no-events" v-if="!filteredEvents || filteredEvents.length === 0">
          No events for this date...
        </div>
        <div
          :id="'event-' + event.EVENTID"
          v-for="event in filteredEvents"
          :key="event.EVENTID"
          @click="recenter(event)"
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
          <div class="time">
            <span class="material-icons md-48"> schedule </span>

            {{ timeConvert(event.TIME) }}
          </div>
          <div class="address">
            <span class="material-icons md-48"> public </span>

            {{ event.ADDRESS }}
          </div>

          <span
            v-show="globalState.auth"
            class="material-icons md-48 saveEvent"
            @click="saveEventForUser(userid, event.EVENTID)"
            :style="{ color: savedEvents.includes(event.EVENTID) ? 'var(--red)' : 'black' }"
          >
            favorite
          </span>

          <attenders class="counter" :count="getAtt(event.EVENTID)" />
        </div>
      </div>
    </div>

    <GoogleMap
      class="map"
      api-key="AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k"
      :center="center"
      :zoom="13"
      v-show="enableMap"
    >
      <CustomMarker
        v-for="(event, i) in filteredEvents"
        :key="i"
        :options="{ position: event.COORDINATES, anchorPoint: 'BOTTOM_CENTER' }"
      >
        <div>
          <div
            style="text-align: center"
            class="eventMarker"
            :class="{ selectedEventMarker: selectedEvent === event.EVENTID }"
          >
            <span class="material-icons" @click="recenter(event)"> star </span>
          </div>
        </div>
      </CustomMarker>
    </GoogleMap>
  </main>
</template>

<style scoped>
.material-icons {
  margin-top: 10px;
  font-size: 30px;
}
.no-events {
  margin: 20px;
  font-size: 25px;
}
.counter {
  position: absolute;
  bottom: 0;
  right: 0;
}
.allEventsTitle {
  color: var(--theme);
  font-size: 30px;
  text-transform: uppercase;
}
.todaysEvents {
  margin: 20px;
}
.date {
  border: none;
  outline: none;
  background: none;
  border-radius: 10px;
  font-size: 25px;
  display: block;
  margin: 10px 0 10px 0;
}

.map {
  height: 100vh;
  width: 100vw;
  position: fixed;
  z-index: -100;
  top: 0;
  left: 0;
  transform: scale(1.1);
}
.eventsContainer {
  font-size: 25px;
  box-shadow: var(--shadow);
  padding: 10px;
  width: 400px;
  position: fixed;
  z-index: 10;
  background: var(--light);
  left: 0;
  top: 70px;
  bottom: 200px;
  height: calc(100% - 90px);
}
.allEvents {
  font-size: 15px;
  height: calc(100% - 190px);
  overflow: scroll;
  margin: 10px 0;
  margin-top: 10px;
  box-shadow: var(--inset-shadow);
  border-radius: 0px;
}

.event {
  margin: 20px;
  box-shadow: var(--shadow);
  border: 1px solid black;
  padding: 20px;
  border-radius: 20px;
  position: relative;
  padding-bottom: 30px;
  background: white;
}
.event .title {
  font-weight: bold;
  font-size: 20px;
}
.saveEvent {
  position: absolute;
  top: 5px;
  right: 10px;
  cursor: pointer;
  font-size: 30px;
}

.today {
  text-align: center;
  font-size: 20px;
}

.eventMarker {
  display: block;
  width: 70px;
  height: 70px;
}
.eventMarker span {
  color: var(--theme);
  font-size: 50px;
  margin: 10px;
}
.selectedEvent {
  background: var(--theme);
  color: white;
  transition: 0.3s;
}
.selectedEventMarker {
  background: var(--theme);
  color: white;
  transition: 0.3s;
  border-radius: 50%;
}
.selectedEventMarker span {
  margin: 10px;
  color: white;
}
.description {
  max-width: 300px;
}
</style>
