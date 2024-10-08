<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
import Events from '../components/Events.vue'

import { read } from '..function/read'

//save login to localstorage
const auth = ref(false)
let userid = localStorage.getItem('userid')
if (userid !== null) {
  console.log('user detected so logging in')
  auth.value = true
}

const router = useRouter()
onMounted(() => {
  if (!auth.value) {
    router.push('/login')
  }
})

const goToRoute = () => {
  router.push('/creator')
}

//
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

async function testing() {
  try {
    const response = await fetch('http://localhost/Read/userSavedEvents.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(userid)
    })

    // Check if the response is OK (status in the range 200-299)
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

testing()
</script>

<template>
  <div v-if="auth">
    <div class="username">{{ user.name }}</div>
    <button @click="goToRoute()" class="creator">Creator</button>

    <div class="savedEvents">
      Saved Events by user
      <div class="events">
        <div v-for="event in user.savedEvents" :key="event.EVENTID" class="event">
          <!-- Individual divs for each event property with their own class -->
          <div class="title"><strong>Title:</strong> {{ event.TITLE }}</div>
          <div class="date"><strong>Date:</strong> {{ event.DATE }}</div>
          <div class="location"><strong>Location:</strong> {{ event.LOCATION }}</div>
          <div class="description"><strong>Description:</strong> {{ event.INFO }}</div>
        </div>
      </div>
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
}
.creator {
  position: fixed;
  top: 20px;
  right: 20px;
  height: 30px;
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

.saved {
  background: red;
}
</style>
