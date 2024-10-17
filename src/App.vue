<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { globalState } from './functions/data.js'

let logout = () => {
  localStorage.removeItem('userid')
  globalState.auth = false
  globalState.userid = null
}
</script>

<template>
  <nav>
    <header>Event.io</header>
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/user">User</RouterLink>

    <button v-if="globalState.auth" class="logout" @click="logout">logout</button>

    <!--     <RouterLink to="/test">testing area</RouterLink> -->

    <!--         <RouterLink to="/about">About</RouterLink> -->
  </nav>

  <RouterView />
</template>

<style scoped>
.logout {
  background: var(--yellow);
  color: black;
}
nav {
  background: var(--theme);
  box-sizing: border-box;
  width: 100%;
  height: 70px;
  z-index: 100;

  box-shadow: var(--shadow);
}

a {
  display: inline-block;
  margin: 10px;
  padding: 10px;
  transition: 0.3s;
  box-shadow: var(--shadow);
  text-transform: uppercase;
  background: var(--green);
}

nav a.router-link-exact-active {
  background: var(--theme);
  box-shadow: var(--inset-shadow);
}

header {
  text-align: right;
  margin: 20px;
  position: absolute;
  text-transform: uppercase;
  font-size: 20px;
  color: white;
  font-weight: bold;
  right: 0;
  width: 200px;
  font-size: 25px;
}
</style>
