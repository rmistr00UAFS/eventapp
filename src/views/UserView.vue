<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
import Events from '../components/Events.vue'

const auth = ref(true)

const router = useRouter()
onMounted(() => {
  if (!auth.value) {
    router.push('/login')
  }
})

const goToRoute = () => {
  router.push('/Creator')
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
</script>

<template>
  <div v-if="auth">
    <div class="username">{{ user.name }}</div>
    <button @click="goToRoute('/about')" class="creator">Creator</button>

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
}
</style>
