<script setup lang="ts">
import { globalState } from '../functions/data.js'
import { timeConvert, getCatName } from '../functions/f.js'
import { deleteSavedEvent } from '../functions/deleteFunctions.js'
import { getSavedEvents } from '../functions/readFunctions.js'

import UserName from './UserName.vue'
import { date } from '../functions/date.js'

getSavedEvents()
</script>

<template>
  <div class="savedEvents">
    <UserName />

    <div class="events-title">Saved events</div>
    <div class="eventsContainer">
      <div v-for="event in globalState.savedEvents" :key="event.EVENTID" class="event">
        <div class="title">{{ event.TITLE }}</div>
        <div class="location">{{ event.LOCATION }}</div>
        <div class="description">{{ event.INFO }}</div>

        <div class="category" v-if="event.CATEGORYID !== 0">
          <span class="material-icons md-48"> info </span>

          {{ getCatName(event.CATEGORYID) }}
        </div>
        <div class="date">
          <span class="material-icons md-48"> event </span>

          {{ date(event.DATE) }}
        </div>
        <div class="time">
          <span class="material-icons md-48"> schedule </span>

          {{ timeConvert(event.TIME) }}
        </div>
        <div class="address">
          <span class="material-icons md-48"> public </span>

          {{ event.ADDRESS }}
        </div>

        <button class="delete-button" @click="deleteSavedEvent(globalState.userid, event.EVENTID)">
          remove
        </button>
      </div>
      <img v-if="!globalState.savedEvents" class="no-events-img" src="/no-event.svg" />
    </div>
  </div>
</template>

<style scoped>
.description {
  min-height: 50px;
  max-height: 50px;
  overflow: scroll;
  box-shadow: var(--inset-shadow);
  padding: 10px;
  margin: 10px 0 10px 0;
  border-radius: 10px;
}
.no-events-img {
  height: 400px;
  margin: auto;
  position: absolute;
  left: 0;
  right: 0;
  top: 200px;
}
.savedEvents {
  padding: 20px;
  margin-top: 70px;
  background: var(--theme);
}

.events-title {
  color: white;
  font-size: 30px;
  text-transform: uppercase;
}

.title {
  font-size: 20px;
  font-weight: bold;
}

.description,
.category,
.date,
.time,
.address {
  padding: 5px;
  font-size: 20px;
}

.event {
  width: 300px;
  min-height: 300px;
  background: white;
  border: 1px solid black;
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 20px;
  border-radius: 20px;
  position: relative;
  display: inline-table;
  padding-bottom: 50px;
}

.delete-button {
  margin-top: 15px;
  font-size: 18px;
  background-color: var(--red);
  position: absolute;
  bottom: 20px;
  right: 20px;
}

.eventsContainer {
  background: var(--light);
  font-size: 15px;
  height: calc(100vh - 170px);
  overflow: scroll;
  margin: 10px 0;
  margin-top: 10px;
  box-shadow: var(--inset-shadow);
  border-radius: 20px;
}
</style>
