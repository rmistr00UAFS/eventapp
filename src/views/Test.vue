<script setup lang="ts">
// const test = {
//   userid: ''
// }
//
// async function testing() {
//   test.userid = localStorage.getItem('userid')
//
//   console.log(test)
//
//   try {
//     const response = await fetch('http://localhost/Read/userSavedEvents.php', {
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json'
//       },
//       body: JSON.stringify(test)
//     })
//
//     // Check if the response is OK (status in the range 200-299)
//     if (!response.ok) {
//       throw new Error(`HTTP error! Status: ${response.status}`)
//     }
//
//     const result = await response.json()
//     console.log(result)
//
//     // console.log(result)
//   } catch (error) {
//     console.log(error)
//   }
// }
//
// testing()

const testSave = {
  time: '11:11:00',
  date: '2024-10-07',
  address: 'fort smith, AR, 72901',
  coordinates: '{"lat": 35.3704608, "lng": -94.4130648}',
  info: '',
  userid: '28',
  eventid: '13',
  type: '0'
}

async function saveEvent() {
  try {
    const response = await fetch('http://localhost/Write/createSavedEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(testSave)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    //go to login state

    console.log(result)
  } catch (error) {
    console.log(error)
  }
}

saveEvent()
</script>

<template></template>

<style scoped></style>
