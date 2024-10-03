<script setup lang="ts">
import { ref } from 'vue'
import Events from '../components/Events.vue'

const form = {
  name: '',
  date: '',
  description: ''
}

async function submitForm() {
  //get creator id
  console.log(form)
  //   try {
  //
  //
  //     const response = await fetch('http://localhost/CRUD.php', {
  //       method: 'POST',
  //       headers: {
  //         'Content-Type': 'application/json'
  //       },
  //       body: JSON.stringify(form)
  //     })
  //
  //     // Check if the response is OK (status in the range 200-299)
  //     if (!response.ok) {
  //       throw new Error(`HTTP error! Status: ${response.status}`)
  //     }
  //
  //     const result = await response.json()
  //
  //     //go to login state
  //     newUser.value = false
  //     console.log(result)
  //   } catch (error) {
  //     console.log(error)
  //   }

  newEvent.value = false
}

let newEvent = ref(false)

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
      Created Events
      <Events :events="user.savedEvents" />
    </div>

    <button @click="createEvent" v-show="!newEvent">create event</button>

    <div class="event-create-form" v-show="newEvent">
      <h2>Create Event</h2>
      <form @submit.prevent="submitForm">
        <div>
          <label for="eventname">Event Name:</label>
          <input type="text" v-model="form.eventname" id="eventname" />
        </div>

        <div>
          <label for="date">Event Date:</label>
          <input type="date" v-model="form.date" id="date" />
        </div>

        <div>
          <label for="time">Event Time:</label>
          <input type="time" v-model="form.time" id="time" />
        </div>

        <div>
          <label for="location">Location:</label>
          <input type="text" v-model="form.location" id="location" />
        </div>

        <div>
          <label for="description">Description:</label>
          <textarea v-model="form.description" id="description"></textarea>
        </div>

        <button type="submit">submit Event</button>
        <button @click="newEvent = false" v-show="newEvent">cancel</button>
      </form>
    </div>
  </div>
</template>
