<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
const router = useRouter()

const form = {
  firstname: '',
  lastname: '',
  password: '', // Note: In practice, you should not expose passwords in JSON responses
  email: '',
  phone: '',
  address: ''
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

    localStorage.setItem('userid', result.userid)
    router.push('/user')

    // console.log(result)
  } catch (error) {
    console.log(error)
  }
}

async function submitForm() {
  try {
    console.log(form)

    const response = await fetch('http://localhost/examples/write.php', {
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

    //go to login state
    newUser.value = false
    console.log(result)
  } catch (error) {
    console.log(error)
  }
}

let newUser = ref(false)

const createUser = () => {
  newUser.value = true
}
</script>

<template>
  <div v-show="!newUser">
    <button @click="createUser">signup</button>
    login in
    <div>
      <label for="password">Password:</label>
      <input type="password" v-model="form.password" id="password" />
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="email" v-model="form.email" id="email" />
    </div>

    <button @click="login">login</button>
  </div>

  <div v-show="newUser">
    create user
    <form @submit.prevent="submitForm">
      <div>
        <label for="firstname">First Name:</label>
        <input type="text" v-model="form.firstname" id="firstname" />
      </div>
      <div>
        <label for="lastname">Last Name:</label>
        <input type="text" v-model="form.lastname" id="lastname" />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="form.password" id="password" />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="form.email" id="email" />
      </div>
      <div>
        <label for="phone">Phone:</label>
        <input type="tel" v-model="form.phone" id="phone" />
      </div>
      <div>
        <label for="address">Address:</label>
        <input type="text" v-model="form.address" id="address" />
      </div>
      <button type="submit">create user</button>
    </form>
  </div>
</template>
