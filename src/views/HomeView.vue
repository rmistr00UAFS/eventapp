<script setup lang="ts">
import { ref } from 'vue'
import TheWelcome from '../components/TheWelcome.vue'
import Events from '../components/Events.vue'

import { GoogleMap, Marker, InfoWindow } from 'vue3-google-map'

const today = 'Friday May 2'

const center = { lat: 35.385803, lng: -94.403229 }

let events = ref()

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
  const event = events.value.find((e) => e.EVENTID === id)
  console.log(event)
}
</script>

<template>
  <main>
    <div class="today">{{ today }}</div>

    <!--     {{ events }} -->

    <!--     {{ getCoordinates(events) }} -->

    <GoogleMap
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

    <!--  <div class="todaysEvents">
      Events for Today
      <Events :events="events" />
    </div>-->
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
</style>
