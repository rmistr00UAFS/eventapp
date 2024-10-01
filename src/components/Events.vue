<template>
  <div class="events">
    <!--     <div class="today">{{ today }}</div> -->
    <div v-for="event in events" :key="event.id" class="event">
      <!-- Individual divs for each event property with their own class -->
      <div class="title"><strong>Title:</strong> {{ event.title }}</div>
      <div class="date"><strong>Date:</strong> {{ event.date }}</div>
      <div class="location"><strong>Location:</strong> {{ event.location }}</div>
      <div class="description"><strong>Description:</strong> {{ event.description }}</div>
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
