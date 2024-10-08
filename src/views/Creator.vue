<script setup lang="ts">
import { ref } from 'vue'
import Events from '../components/Events.vue'

const event = {
  title: 'tyjty',
  date: '0001-01-01',
  time: '11:11',
  info: '',
  address: 'fort smith, AR, 72901',
  coordinates: '',
  categoryid: '',
  organizerid: ''
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
  savedEvents: [
    {
      id: 1,
      title: 'Music Concert',
      date: '2024-10-10',
      location: 'City Hall',
      description: 'An evening of classical music featuring local artists.'
    },
    {
      id: 2,
      title: 'Art Exhibition',
      date: '2024-11-05',
      location: 'Art Gallery',
      description: 'Showcasing contemporary art from various artists.'
    }
  ]
})
</script>

<template>
  <div>
    <div class="savedEvents">
      events created by user
      <Events :events="user.savedEvents" />
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
