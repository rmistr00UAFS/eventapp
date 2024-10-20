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

        <span v-show="globalState.auth" class="material-icons md-48 bookmarkEvent"> favorite </span>

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
.event {
  display: inline-block;
  width: 200px;
  box-shadow: var(--shadow);
}
</style>
