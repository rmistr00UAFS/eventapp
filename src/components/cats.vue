<script setup lang="ts">
import { ref } from 'vue'
import { getCats } from '../functions/getCats'

import { globalState } from '../functions/data.js'

let selectCat = (cat) => {
  if (cat) {
    console.log(cat.TYPE)
    globalState.selectedCatID = cat.CA_ID

    let id = globalState.selectedCatID

    globalState.filteredEvents = globalState.events.filter((event) => event.CATEGORYID == id)
  } else {
    globalState.filteredEvents = globalState.events
  }
}
</script>

<template>
  <div class="cats">
    <select v-model="cat" class="catTypes">
      <option selected @click="selectCat()"></option>

      <option
        v-for="cat in globalState.cats"
        :key="cat.TYPE"
        :value="cat.TYPE"
        @click="selectCat(cat)"
      >
        {{ cat.TYPE }}
      </option>
    </select>
  </div>
</template>

<style scoped>
.cats {
  /*   color: var(--theme); */
}
.catType {
  display: inline-block;
}
</style>
