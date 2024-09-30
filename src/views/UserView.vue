<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
const auth = ref(false)

const router = useRouter()
onMounted(() => {
  if (!auth.value) {
    router.push('/login')
  }
})

//
const user = ref({
  name: 'dan'
})
</script>

<template>
  <div v-if="auth">{{ user.name }}</div>
</template>
