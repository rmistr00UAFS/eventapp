<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'

import { globalState } from '../functions/data.js'

const form = {
  firstname: '',
  lastname: '',
  password: '',
  email: '',
  phone: '',
  address: ''
}

async function login() {
  try {
    const response = await fetch('http://localhost/Read/userLogin.php', {
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

    if (result.userid) {
      localStorage.setItem('userid', result.userid)
      globalState.auth = true
      globalState.userid = result.userid
    }

    console.log(result)
  } catch (error) {
    console.log(error)
  }
}

async function submitForm() {
  try {
    console.log(form)

    const response = await fetch('http://localhost/Write/createUser.php', {
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

let cancel = () => {
  newUser.value = false
}
</script>

<template>
  <div class="login-container">
    <img v-show="!newUser" class="cover-img" src="/login.svg" />
    <img v-show="newUser" class="cover-img" src="/events.svg" />

    <div v-show="!newUser">
      <div class="login">
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="form.email" id="email" />
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" v-model="form.password" id="password" />
        </div>

        <button class="login-button" @click="login">login</button>
        <button @click="createUser">signup</button>
      </div>
    </div>

    <div v-show="newUser" class="signup">
      <form @submit.prevent="submitForm">
        <div>
          <label for="firstname">First Name</label>
          <input type="text" v-model="form.firstname" id="firstname" />
        </div>
        <div>
          <label for="lastname">Last Name</label>
          <input type="text" v-model="form.lastname" id="lastname" />
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" v-model="form.password" id="password" />
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" v-model="form.email" id="email" />
        </div>
        <div>
          <label for="phone">Phone</label>
          <input type="tel" v-model="form.phone" id="phone" />
        </div>
        <div>
          <label for="address">Address</label>
          <input type="text" v-model="form.address" id="address" />
        </div>
        <button class="create-button" type="submit">create user</button>
        <button @click="cancel">cancel</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.login-container {
  margin-top: 100px;
}
.cover-img {
  position: absolute;
  bottom: 0;
  right: 0;
  margin: 100px;
  width: 500px;
}
.signup {
  padding: 20px;
  border-radius: 20px;
  margin: 20px;
  box-shadow: var(--shadow);
  max-width: 300px;
}
input {
  border-radius: 10px;
}
.create-button {
  margin-top: 20px;
  margin-right: 20px;
}

.login-button {
  margin-top: 20px;
  margin-right: 20px;
}
label {
  display: block;
  margin: 10px 0 10px 0;
  text-transform: uppercase;
}
.login {
  padding: 20px;
  border-radius: 20px;
  margin: 20px;
  box-shadow: var(--shadow);
  max-width: 300px;
}
</style>
