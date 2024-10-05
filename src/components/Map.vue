<script setup lang="ts">
/*
const center = { lat: 40.689247, lng: -74.044502 }

const setCenter = () => {
  center = {
    lat: event.latLng.lat(),
    lng: event.latLng.lng()
  }
}

console.log(center)*/
</script>

<template>
  <div class="map"></div>
</template>

<style scoped>
.map {
  width: calc(100% - 40px);
  box-shadow: var(--inset-shadow);
  margin: 20px;
  padding: 10px;
  border-radius: 5px;
  height: 200px;
}
</style>
