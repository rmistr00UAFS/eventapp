<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
import Events from '../components/Events.vue'

import { read } from '..function/read'
import { getSavedEvents } from '../functions/getSavedEvents'

import { api } from '../functions/api'
import Login from './LoginView.vue'

import { globalState } from '../functions/data.js'

let userid = localStorage.getItem('userid')
if (userid !== null) {
  console.log('user detected so logging in')
  globalState.auth = true
}

getSavedEvents(userid)
  .then((data) => {
    user.value.savedEvents = data.events
  })
  .catch((error) => {
    console.error('Error fetching saved events:', error)
  })

async function deleteSavedEvent(userid, eventid) {
  user.value.savedEvents = user.value.savedEvents.filter((event) => event.EVENTID != eventid)
  try {
    const response = await fetch('http://localhost/Write/deleteSavedEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userid, eventid })
    })

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    console.log(result)

    // console.log(result)
  } catch (error) {
    console.log(error)
  }
}
</script>

<template>
  <div class="savedEvents">
    <div class="events">
      Upcoming events

      <div v-for="event in user.savedEvents" :key="event.EVENTID" class="event">
        <!-- Individual divs for each event property with their own class -->
        <div class="title"><strong>Title:</strong> {{ event.TITLE }}</div>
        <div class="date"><strong>Date:</strong> {{ event.DATE }}</div>
        <div class="location"><strong>Location:</strong> {{ event.LOCATION }}</div>
        <div class="description"><strong>Description:</strong> {{ event.INFO }}</div>
        <button @click="deleteSavedEvent(userid, event.EVENTID)">delete</button>
      </div>
    </div>
  </div>
</template>

<style>
.savedEvents {
  margin: 20px;
  position: absolute;
  top: 100px;

  width: 300px;
}
</style>
