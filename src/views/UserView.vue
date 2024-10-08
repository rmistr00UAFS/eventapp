<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
import Events from '../components/Events.vue'

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
      Saved Events
      <Events :events="user.savedEvents" />
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
</style>
