<script setup lang="ts">
const center = {
  lat: 37.7749, // Default latitude
  lng: -122.4194 // Default longitude (San Francisco)
}

const setCenter = () => {
  center = {
    lat: event.latLng.lat(),
    lng: event.latLng.lng()
  }
}

console.log(center)
</script>

<template>
  <div class="map">
    <!-- <GMapMap :center="center" :zoom="12" @click="setCenter">
      <GMapMarker :position="center" />
    </GMapMap>-->

    <!--    <gmp-map center="37.4220656,-122.0840897" zoom="10" map-id="DEMO_MAP_ID" style="height: 400px">
      <gmp-advanced-marker
        position="37.4220656,-122.0840897"
        title="Mountain View, CA"
      ></gmp-advanced-marker>
    </gmp-map>-->

    <div>
      <p>Latitude: {{ center.lat }}</p>
      <p>Longitude: {{ center.lng }}</p>
    </div>
  </div>
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
