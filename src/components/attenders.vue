<script>
// import { getAllAttenders } from '../functions/getAllAttenders'
// import { ref } from 'vue'
// let count = ref()
// getAllAttenders(42).then((data) => {
//   count.value = data.attendees.length
// })

export default {
  props: {
    count: {
      type: Number,
      required: true
    }
  }
}
</script>

<template>
  <div class="counter"><span class="material-icons md-48"> person </span>{{ count }}</div>
</template>

<style scoped>
.counter {
  display: inline-block;
  margin: 10px;

  border-radius: 50%;
}

.counter span {
  font-size: 30px ;
}
</style>
