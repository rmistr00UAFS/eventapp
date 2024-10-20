<script setup lang="ts">
import { ref } from 'vue'

let event = {
  title: 'Art in the Park',
  date: '2024-10-20',
  time: '10:00',
  info: 'An open-air art exhibition showcasing local artists.',
  address: 'Fort Smith, AR, 72901',
  coordinates: '{"lat":35.387533,"lng":-94.404191}',
  categoryid: '1',
  userid: '502'
}

let eventForm = ref(true)
</script>

<template>
  <button class="creator" @click="eventForm = !eventForm" v-show="!eventForm">Create</button>

  <div v-show="eventForm" class="eventForm">
    <Cats />
    <div>
      <label for="title">title</label>
      <input id="title" v-model="event.title" type="text" placeholder="Enter event title" />

      <label for="date">Date</label>
      <input id="date" v-model="event.date" type="date" />

      <label for="time">Time</label>
      <input id="time" v-model="event.time" type="time" />

      <label for="info">Info</label>
      <textarea id="info" v-model="event.info" placeholder="Enter event information"></textarea>

      <label for="address">Address</label>
      <input id="address" v-model="event.address" type="text" placeholder="Enter event address" />

      <div v-show="!editFormState">
        <button class="submit-button" @click="createEvent">submit Event</button>
      </div>

      <div v-show="editFormState">
        <button class="update-button" @click="updateCreatedEvent">update Event</button>

        <button class="delete-button" @click="deleteCreatedEvent">delete</button>
      </div>
    </div>

    <button class="cancel-button" @click="eventForm = false" v-show="eventForm">cancel</button>
  </div>
</template>

<style scoped></style>
