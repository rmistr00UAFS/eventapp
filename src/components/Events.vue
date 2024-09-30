<template>
  <div>
    <h1>Event List</h1>
      <div v-for="event in events" :key="event.USERID">

      <div>{{event.USERID}}</div>
      <div>{{event.FIRSTNAME}}</div>
        <div>{{event.LASTNAME}}</div>

      </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      events: [

      ]
    }
  },
   mounted() {
    this.getEvents();
  },
  methods: {
    getEvents() {
      fetch('http://localhost/getEvents.php')
        .then(response => response.json())
        .then(data => {
          console.log(data);
          this.events = data;
        })
        .catch(error => {
console.log(error);
        });
    }
  }
}
</script>
