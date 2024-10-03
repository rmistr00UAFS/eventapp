<script setup lang="ts">
import { ref } from 'vue'
import TheWelcome from '../components/TheWelcome.vue'
import Events from '../components/Events.vue'

import Map from '../components/Map.vue'

const today = 'Friday May 2'

const events = [
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
  },
  {
    id: 3,
    title: 'Food Festival',
    date: '2024-09-20',
    location: 'Downtown Park',
    description: 'A weekend festival celebrating local cuisine.'
  },
  {
    id: 4,
    title: 'Tech Conference',
    date: '2024-12-15',
    location: 'Convention Center',
    description: 'Join industry leaders to discuss the future of technology.'
  }
]
</script>

<template>
  <main>
    <div class="today">{{ today }}</div>

    <Map />

    <div class="todaysEvents">
      Events for Today
      <Events :events="events" />
    </div>
  </main>
</template>

<style scoped>
.todaysEvents {
  margin: 20px;
}
.today {
  margin: 20px;
}
</style>
