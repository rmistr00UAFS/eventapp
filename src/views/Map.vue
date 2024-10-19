<script setup lang="ts">
import { watch, ref, computed } from 'vue'
import { GoogleMap, Marker, CustomMarker, InfoWindow } from 'vue3-google-map'

import { globalState } from '../functions/data.js'

let selectedEvent = ref() //id

let center = ref({ lat: 35.385803, lng: -94.403229 })
let recenter = (event) => {
  center.value = event.COORDINATES
  selectedEvent.value = event.EVENTID

  globalState.selectedEvent = event

  const eventElement = document.getElementById(`event-${event.EVENTID}`)
  if (eventElement) {
    eventElement.scrollIntoView({ behavior: 'smooth', block: 'center' }) // Smooth scrolling to the event
  } else {
    console.error(`Event with ID ${event.EVENTID} not found`) // Log if event is not found
  }
}

watch(globalState, (newValue, oldValue) => {
  center.value = newValue.selectedEvent.COORDINATES
})

let enableMap = ref(true)
</script>

<template>
  <GoogleMap
    class="map"
    api-key="AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k"
    :center="center"
    :zoom="13"
    v-show="enableMap"
  >
    <CustomMarker
      v-for="(event, i) in globalState.filteredEvents.value"
      :key="i"
      :options="{ position: event.COORDINATES, anchorPoint: 'BOTTOM_CENTER' }"
    >
      <div>
        <div
          style="text-align: center"
          class="eventMarker"
          :class="{ selectedEventMarker: selectedEvent.value === event.EVENTID }"
        >
          <span class="material-icons" @click="recenter(event)"> star </span>
        </div>
      </div>
    </CustomMarker>
  </GoogleMap>
</template>

<style scoped>
.map {
  height: 100vh;
  width: 100vw;
  position: fixed;
  z-index: -100;
  top: 0;
  left: 0;
  transform: scale(1.1);
}

.eventMarker {
  display: block;
  width: 70px;
  height: 70px;
}
.eventMarker span {
  color: var(--red);
  font-size: 50px;
  margin: 10px;
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
</style>
