<script setup lang="ts">
import { ref } from 'vue'
import Events from '../components/Events.vue'

const event = {
  title: 'Art in the Park',
  date: '2024-09-05',
  time: '10:00',
  info: 'An open-air art exhibition showcasing local artists.',
  address: 'Fort Smith, AR, 72901',
  coordinates: '{"lat":35.387533,"lng":-94.404191}', // Another set of coordinates for Fort Smith
  categoryid: '302',
  userid: '502'
}

const getCoordinates = () => {
  const API = 'AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k'

  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(event.address)}&key=${API}`

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      if (data.status === 'OK') {
        const location = data.results[0].geometry.location

        event.coordinates = JSON.stringify(location)

        event.organizerid = localStorage.getItem('userid')

        console.log(event)

        submitEvent()
      } else {
        console.error('Error: ' + data.status)
      }
    })
    .catch((error) => console.error('Fetch error: ' + error))
}

let newEvent = ref(false)

async function submitEvent() {
  event.userid = localStorage.getItem('userid')
  try {
    const response = await fetch('http://localhost/Write/createEvent.php', {
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

    //go to login state

    console.log(result)

    testing()
  } catch (error) {
    console.log(error)
  }

  newEvent.value = false
}

const createEvent = () => {
  newEvent.value = true
}

const user = ref({
  name: 'john doe',
  savedEvents: []
})

const test = {
  userid: ''
}

async function testing() {
  test.userid = localStorage.getItem('userid')

  try {
    const response = await fetch('http://localhost/Read/getCreatorEvents.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(test)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    console.log(result)
    user.value.savedEvents = result.events

    // console.log(result)
  } catch (error) {
    console.log(error)
  }
}

testing()
</script>

<template>
  <div>
    <div class="savedEvents">
      events created by user .events { width: calc(100%); box-shadow: var(--inset-shadow); padding:
      10px; border-radius: 5px; overflow: scroll; height: 300px; } .event { margin: 20px;
      box-shadow: var(--shadow); padding: 10px; border-radius: 5px; } .title { color: red; } .today
      { text-align: center; font-size: 20px; } .saved { background: red; }
    </div>

    <button @click="createEvent" v-show="!newEvent">create event</button>

    <div v-show="newEvent">
      <h2>Create Event</h2>
      <form @submit.prevent="getCoordinates">
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

        <button type="submit">submit Event</button>
      </form>

      <button @click="newEvent = false" v-show="newEvent">cancel</button>
    </div>
  </div>
</template>
