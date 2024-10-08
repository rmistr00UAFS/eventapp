<script setup lang="ts">
import { ref } from 'vue'
import TheWelcome from '../components/TheWelcome.vue'
import Events from '../components/Events.vue'
import { GoogleMap, Marker, InfoWindow } from 'vue3-google-map'
import { date } from '../functions/date' // Adjust the path as necessary

const center = { lat: 35.385803, lng: -94.403229 }

let events = ref()

let savedEvents = ref([17])

const getAllEvents = () => {
  const url = 'http://localhost/Read/getEvents.php'

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      data.events.map((x) => {
        x.COORDINATES = JSON.parse(x.COORDINATES)
      })

      events.value = data.events
    })
    .catch((error) => {
      console.error('Error fetching events:', error)
    })
}

getAllEvents()

const saveEvent = (id) => {
  if (savedEvents.value.includes(id)) {
    // Remove the event ID if it's already in savedEvents
    savedEvents.value = savedEvents.value.filter((EVENTID) => EVENTID !== id)
  } else {
    // Otherwise, add it
    savedEvents.value.push(id)
  }
  console.log(savedEvents)
}

let viewMode = ref(false)
</script>

<template>
  <main>
    <button class="today">{{ date() }}</button>

    <button @click="viewMode = !viewMode">view mode {{ viewMode ? 'map' : 'list' }}</button>

    <div class="todaysEvents" v-show="!viewMode">
      all events for today
      <div class="events">
        <div
          v-for="event in events"
          :key="event.EVENTID"
          class="event"
          @click="saveEvent(event.EVENTID)"
          :class="{ saved: savedEvents.includes(event.EVENTID) }"
        >
          <!-- Individual divs for each event property with their own class -->
          <div class="title"><strong>Title:</strong> {{ event.TITLE }}</div>
          <div class="date"><strong>Date:</strong> {{ event.DATE }}</div>
          <div class="location"><strong>Location:</strong> {{ event.LOCATION }}</div>
          <div class="description"><strong>Description:</strong> {{ event.INFO }}</div>
        </div>
      </div>
    </div>

    <GoogleMap
      v-show="viewMode"
      class="map"
      api-key="AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k"
      :center="center"
      :zoom="13"
    >
      <Marker v-for="(event, i) in events" :key="i" :options="{ position: event.COORDINATES }">
        <InfoWindow>
          <div class="title"><strong>Title:</strong> {{ event.TITLE }}</div>
          <div class="date"><strong>Date:</strong> {{ event.DATE }}</div>
          <div class="description"><strong>Description:</strong> {{ event.INFO }}</div>
          <button @click="saveEvent(event.EVENTID)">save</button>
        </InfoWindow>
      </Marker>
    </GoogleMap>
  </main>
</template>

<style scoped>
.todaysEvents {
  margin: 20px;
}
.today {
  margin: 20px;
}

.map {
  height: 100vh;
  width: 100vw;
}

.events {
  width: calc(100%);
  box-shadow: var(--inset-shadow);
  padding: 10px;
  border-radius: 5px;

  overflow: scroll;
  height: 300px;
}

.event {
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 10px;
  border-radius: 5px;
}

.title {
  color: red;
}

.today {
  text-align: center;
  font-size: 20px;
}

.saved {
  background: red;
}
</style>
