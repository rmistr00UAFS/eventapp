<script setup lang="ts">
import { ref } from 'vue'
import TheWelcome from '../components/TheWelcome.vue'
import Events from '../components/Events.vue'

import { GoogleMap, Marker, InfoWindow } from 'vue3-google-map'

const today = 'Friday May 2'

const center = { lat: 35.385803, lng: -94.403229 }

const events = [
  {
    id: 1,
    title: 'Music Concert',
    date: '2024-10-10',
    location: 'City Hall',
    description: 'An evening of classical music featuring local artists.',
    location: { lat: center.lat - 0.01, lng: center.lng - 0.01 }
  },
  {
    id: 2,
    title: 'Art Exhibition',
    date: '2024-11-05',
    location: 'Art Gallery',
    description: 'Showcasing contemporary art from various artists.',
    location: { lat: center.lat + 0.01, lng: center.lng + 0.01 }
  }
]

const saveEvent = (id) => {
  console.log(id)
}
</script>

<template>
  <main>
    <div class="today">{{ today }}</div>

    <!--    <GoogleMap
      class="map"
      api-key="AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k"
      :center="center"
      :zoom="13"
    >
      <Marker v-for="(event, i) in events" :key="i" :options="{ position: event.location }">
        <InfoWindow>
          <div class="title"><strong>Title:</strong> {{ event.title }}</div>
          <div class="date"><strong>Date:</strong> {{ event.date }}</div>

          <div class="description"><strong>Description:</strong> {{ event.description }}</div>

          <button @click="saveEvent(event.id)">save</button>
        </InfoWindow>
      </Marker>
    </GoogleMap>-->

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
