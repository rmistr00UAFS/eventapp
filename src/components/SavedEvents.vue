<script setup lang="ts">
import { globalState } from '../functions/data.js'
import { timeConvert, getCatName } from '../functions/f.js'
import { deleteSavedEvent } from '../functions/deleteFunctions.js'
import { getSavedEvents } from '../functions/readFunctions.js'

getSavedEvents()
</script>

<template>
  <div class="savedEvents">
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

          {{ event.DATE }}
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
    </div>
  </div>
</template>

<style scoped>
.savedEvents {
  padding: 20px;
}

.events-title {
  color: var(--theme);
  font-size: 40px;
  text-transform: uppercase;
}

.title {
  color: var(--theme);
  font-size: 23px;
  padding: 3px;
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
  width: 619px;
  min-height: 250px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  border: 1px solid black;
  margin: 20px;
  box-shadow: var(--shadow);
  padding: 20px;
  border-radius: 20px;
  position: relative;
  display: inline-block;
}

.delete-button {
  margin-top: 15px;
  font-size: 18px;
  background-color: red;
  position: absolute;
  bottom: 10px;
  right: 10px;
}

.eventsContainer {
  font-size: 15px;
  height: calc(100vh - 170px);
  overflow: scroll;
  margin: 10px 0;
  margin-top: 10px;
  box-shadow: var(--inset-shadow);
  border-radius: 0px;
}
</style>
