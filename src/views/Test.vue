<script setup lang="ts">
import { ref } from 'vue'

const form = {
  userid: 1,
  firstname: 'john',
  lastname: 'Doe',
  password: 'xyz', // Note: In practice, you should not expose passwords in JSON responses
  email: 'xyz@x.com',
  phone: '1234567890',
  address: '123 Main St, Springfield'
}

async function login() {
  console.log(form)
  try {
    const response = await fetch('http://localhost/examples/read.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(form)
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

login()
</script>

<template>TESTING AREA</template>

<style scoped></style>
