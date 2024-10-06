<script setup lang="ts">
import { ref } from 'vue'
import Events from '../components/Events.vue'

const event = {
  title: 'tyjty',
  date: '2/2/2000',
  time: '11:11',
  info: '',
  address: 'fort smith, AR, 72901',
  coordinates: '{lat: 35.395803, lng: -94.413229}',
  categoryid: '',
  organizerid: ''
}

const getCoordinates = (address) => {
  const API = 'AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k'

  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${API}`

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      if (data.status === 'OK') {
        const location = data.results[0].geometry.location
        event.location = location
      } else {
        console.error('Error: ' + data.status)
      }
    })
    .catch((error) => console.error('Fetch error: ' + error))
}

let newEvent = ref(false)

async function submitEvent() {
  // // console.log(event)
  // getCoordinates(form.address).then(() => {
  //   console.log(event)
  // })
  // // console.log(coord)

  //get creator id

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
    newEvent.value = false
    console.log(result)
  } catch (error) {
    console.log(error)
  }

  // newEvent.value = false
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
    address
    <div class="savedEvents">
      Created Events
      <Events :events="user.savedEvents" />
    </div>

    <button @click="createEvent" v-show="!newEvent">create event</button>

    <button @click="getCoordinates('fort smith,AR 72901')" v-show="!newEvent">check</button>

    <h2>Create Event</h2>
    <form @submit.prevent="submitEvent">
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

      <label for="coordinates">Coordinates:</label>
      <input
        id="coordinates"
        v-model="event.coordinates"
        type="text"
        placeholder="Enter event coordinates (e.g., lat,long)"
      />

      <label for="categoryid">Category ID:</label>
      <input
        id="categoryid"
        v-model="event.categoryid"
        type="text"
        placeholder="Enter category ID"
      />

      <label for="organizerid">Organizer ID:</label>
      <input
        id="organizerid"
        v-model="event.organizerid"
        type="text"
        placeholder="Enter organizer ID"
      />
      <button type="submit">submit Event</button>
      <button @click="newEvent = false" v-show="newEvent">cancel</button>
    </form>
  </div>
</template>
