<script setup lang="ts">
import { ref } from 'vue'

// Reactive email and username state
const email = ref('')
const username = ref('')

// Function to handle form submission
const handleSubmit = () => {
  console.log('Email:', email.value)
  console.log('Username:', username.value)
}
</script>

<template>
  <div>
    <form @submit.prevent="handleSubmit">
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>

      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" required />
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>
</template>
