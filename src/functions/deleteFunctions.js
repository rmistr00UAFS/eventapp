import { getSavedEvents, getCreatedEvents } from '../functions/readFunctions.js'

export async function deleteSavedEvent(userid, eventid) {
  try {
    const response = await fetch('http://localhost/Write/deleteSavedEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userid, eventid })
    })

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    getSavedEvents()
    // console.log(result)
  } catch (error) {
    console.log(error)
  }
}

export async function deleteCreatedEvent(eventid) {
  try {
    const response = await fetch('http://localhost/Write/deleteEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ eventid })
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    api(globalState.userid, 'http://localhost/Read/getCreatorEvents.php').then((events) => {
      user.value.createdEvents = events.events
      editFormState.value = false
      eventForm.value = false
    })

    getCreatedEvents()
  } catch (error) {
    console.log(error)
  }
}
