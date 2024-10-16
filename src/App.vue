<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
// import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <nav>
    <header>Event.io</header>
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/user">User</RouterLink>
    <!--     <RouterLink to="/test">testing area</RouterLink> -->

    <!--         <RouterLink to="/about">About</RouterLink> -->
  </nav>

  <RouterView />
</template>

<style scoped>
nav {
  background: white;
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
}

nav a.router-link-exact-active {
  background: var(--green);
  box-shadow: var(--inset-shadow);
}

header {
  text-align: center;
  margin: 20px auto;
  position: absolute;
  text-transform: uppercase;
  font-size: 20px;
  color: var(--theme);
  font-weight: bold;
  left: 0;
  right: 0;
  width: 200px;
  font-size: 25px;
}
</style>
