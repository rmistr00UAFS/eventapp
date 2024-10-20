<script setup lang="ts">
import { ref } from 'vue'
import { getCats } from '../functions/getCats'

import { globalState } from '../functions/data.js'

let catTypes = ref()
getCats().then((res) => {
  catTypes.value = res.cats
})

let cat = ref(null)

let selectCat = () => {
  globalState.selectedCat = cat
}
</script>

<template>
  <div class="cats">
    <select v-model="cat" class="catTypes" @change="selectCat">
      <option :value="null" selected></option>

      <option v-for="catType in catTypes" :key="catType" :value="catType">
        {{ catType.TYPE }}
      </option>
    </select>
  </div>
</template>

<style scoped>
.cats {
  margin-top: 30px;
  /*   color: var(--theme); */
}
.catType {
  display: inline-block;
}
</style>
