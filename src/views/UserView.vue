<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref, onMounted, watch } from 'vue'
import Events from '../components/Events.vue'

import { read } from '..function/read'
import { getSavedEvents } from '../functions/getSavedEvents'

import { api } from '../functions/api'
import Login from './LoginView.vue'

import { globalState } from '../functions/data.js'

import Cats from '../components/cats.vue'

let userid = localStorage.getItem('userid')
if (userid !== null) {
  console.log('user detected so logging in')
  globalState.auth = true
}

const user = ref({
  name: 'john doe',
  savedEvents: [],
  createdEvents: []
})

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
async function deleteCreatedEvent() {
  let eventid = currentEventID.value

  try {
    const response = await fetch('http://localhost/Write/deleteEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ eventid })
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    api(userid, 'http://localhost/Read/getCreatorEvents.php').then((events) => {
      user.value.createdEvents = events.events
      editFormState.value = false
      eventForm.value = false
    })

    getSavedEvents(userid)
      .then((data) => {
        user.value.savedEvents = data.events
      })
      .catch((error) => {
        console.error('Error fetching saved events:', error)
      })
  } catch (error) {
    console.log(error)
  }
}

async function updateCreatedEvent() {
  // Set the event ID and user ID
  event.eventid = currentEventID.value
  event.userid = userid

  try {
    // Wait for the coordinates to be retrieved
    await getCoordinates()
    // Then submit the updated event
    await submitUpdatedEvent()

    getSavedEvents(userid)
      .then((data) => {
        user.value.savedEvents = data.events
      })
      .catch((error) => {
        console.error('Error fetching saved events:', error)
      })
  } catch (error) {
    console.error('Error updating event:', error)
  }
}

async function submitUpdatedEvent() {
  try {
    const response = await fetch('http://localhost/Write/updateEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(event)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    api(userid, 'http://localhost/Read/getCreatorEvents.php').then((events) => {
      user.value.createdEvents = events.events
      editFormState.value = false
      eventForm.value = false
    })
  } catch (error) {
    console.log(error)
  }
}

api(userid, 'http://localhost/Read/getCreatorEvents.php').then((events) => {
  user.value.createdEvents = events.events
})

let eventForm = ref(false)
const createEventButton = () => {
  eventForm.value = true
}
let event = {
  title: 'Art in the Park',
  date: '2024-10-15',
  time: '10:00',
  info: 'An open-air art exhibition showcasing local artists.',
  address: 'Fort Smith, AR, 72901',
  coordinates: '{"lat":35.387533,"lng":-94.404191}',
  categoryid: '1',
  userid: '502'
}

async function getCoordinates() {
  const API = 'AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k'
  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(event.address)}&key=${API}`

  try {
    const response = await fetch(url)
    const data = await response.json()

    if (data.status === 'OK' && data.results.length > 0) {
      const location = data.results[0].geometry.location

      // Store the coordinates as a JSON string or directly as an object
      event.coordinates = JSON.stringify(location)

      // Set the user ID for the event
      event.userid = userid

      console.log('Coordinates successfully retrieved:', location)
    } else {
      console.error('Geocoding error:', data.status, data.error_message || 'No results found.')
    }
  } catch (error) {
    console.error('Fetch error:', error)
  }
}

let createEvent = async () => {
  try {
    await getCoordinates() // Wait for getCoordinates to complete
    await submitEvent() // Then call submitEvent
  } catch (error) {
    console.error('Error creating event:', error)
  }
}
async function submitEvent() {
  event.userid = userid

  try {
    const response = await fetch('http://localhost/Write/createEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(event)
    })

    const result = await response.json()

    if (result) {
      api(userid, 'http://localhost/Read/getCreatorEvents.php').then((events) => {
        user.value.createdEvents = events.events
      })
    }
  } catch (error) {
    console.log(error)
  }

  eventForm.value = false
}

let editFormState = ref(false)
let currentEventID = ref()
let editForm = (eventid) => {
  editFormState.value = true
  eventForm.value = true
  currentEventID.value = eventid

  let eventFormUpdate = user.value.createdEvents.find((event) => event.EVENTID === eventid)

  for (const key in eventFormUpdate) {
    event[key.toLowerCase()] = eventFormUpdate[key]
  }
}
let cancel = () => {
  eventForm.value = false
  editFormState.value = false
}
let logout = () => {
  localStorage.removeItem('userid')
  globalState.auth = false
}

watch(globalState, (newValue, oldValue) => {
  let id = newValue.selectedCat.CA_ID
  event.categoryid = id
})
</script>

<template>
  <div v-if="!globalState.auth">
    <Login />
  </div>
  <div v-if="globalState.auth">
    <button class="logout" @click="logout">logout</button>

    <div class="username">{{ user.name }}</div>
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

    <div class="createdEvents">
      <div class="events">
        Events created by you
        <button class="creator" @click="createEventButton" v-show="!eventForm">Create</button>

        <div v-for="event in user.createdEvents" :key="event.EVENTID" class="event">
          <!-- Individual divs for each event property with their own class -->
          <div class="title"><strong>Title:</strong> {{ event.TITLE }}</div>
          <div class="date"><strong>Date:</strong> {{ event.DATE }}</div>
          <div class="location"><strong>Location:</strong> {{ event.LOCATION }}</div>
          <div class="description"><strong>Description:</strong> {{ event.INFO }}</div>
          <button @click="editForm(event.EVENTID)">edit</button>
        </div>
      </div>
    </div>

    <div v-show="eventForm" class="eventForm">
      <h2>Create Event</h2>
      <Cats />
      <div>
        <label for="title">title:</label>
        <input id="title" v-model="event.title" type="text" placeholder="Enter event title" />

        <label for="date">Date:</label>
        <input id="date" v-model="event.date" type="date" />

        <label for="time">Time:</label>
        <input id="time" v-model="event.time" type="time" />

        <label for="info">Info:</label>
        <textarea id="info" v-model="event.info" placeholder="Enter event information"></textarea>

        <label for="address">Address:</label>
        <input id="address" v-model="event.address" type="text" placeholder="Enter event address" />

        <div v-show="!editFormState">
          <button @click="createEvent">submit Event</button>
        </div>

        <div v-show="editFormState">
          <button @click="updateCreatedEvent">update Event</button>

          <button @click="deleteCreatedEvent">delete</button>
        </div>
      </div>

      <button @click="cancel" v-show="eventForm">cancel</button>
    </div>
  </div>
</template>

<style>
.username {
  margin: 20px;
  text-transform: uppercase;
}
.savedEvents {
  margin: 20px;
  position: absolute;
  top: 100px;

  width: 300px;
}
.createdEvents {
  margin: 20px;
  position: absolute;
  top: 100px;
  right: 40px;
  width: 300px;
}
.creator {
  position: absolute;
  top: 20px;
  right: -20px;
  height: 30px;
}

.events {
  width: calc(100%);
  box-shadow: var(--inset-shadow);
  padding: 20px;
  border-radius: 20px;
  overflow: scroll;
  height: calc(100vh - 180px);
}

.event {
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 10px;
  border-radius: 5px;
}
.eventForm {
  transition: 0.3s;
  position: fixed;
  left: 0;
  right: 0;
  margin: auto;
  width: 300px;
  background: white;
  border-radius: 20px;
  box-shadow: var(--shadow);
  padding: 20px;
}

.logout {
  position: fixed;
  right: 0;
  top: 0;
  margin: 20px;
}
</style>
