<template>
  <div class="events">
    <!--     <div class="today">{{ today }}</div> -->
    <div v-for="event in events" :key="event.EVENTID" class="event">
      <!-- Individual divs for each event property with their own class -->
      <div class="title"><strong>Title:</strong> {{ event.TITLE }}</div>
      <div class="date"><strong>Date:</strong> {{ event.DATE }}</div>
      <div class="location"><strong>Location:</strong> {{ event.LOCATION }}</div>
      <div class="description"><strong>Description:</strong> {{ event.INFO }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    events: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>
.events {
  width: calc(100%);
  box-shadow: var(--inset-shadow);
  padding: 10px;
  border-radius: 5px;

  overflow: scroll;
  height: 300px;
}

.event {
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 10px;
  border-radius: 5px;
}

.today {
  text-align: center;
  font-size: 20px;
}
</style>
