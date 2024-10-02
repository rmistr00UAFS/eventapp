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

console.log('test')

async function testPost() {
  const data = {
    userid: 1,
    firstname: 'wefkln',
    lastname: 'Doe',
    password: 'secret', // Note: In practice, you should not expose passwords in JSON responses
    email: 'john@example.com',
    phone: '1234567890',
    address: '123 Main St, Springfield'
  }

  try {
    const response = await fetch('http://localhost/CRUD.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    console.log(result)
  } catch (error) {
    console.log(error)
  }
}
</script>

<template>
  <div>
    <button v-once @click="testPost">Submit</button>
    <!--  <form @submit.prevent="handleSubmit">
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>

      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" required />
      </div>

      <button type="submit">Submit</button>
      <button>reset password</button>
    </form>-->
  </div>
</template>
