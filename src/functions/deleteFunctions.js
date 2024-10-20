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
    console.log(result)
    getSavedEvents()
  } catch (error) {
    console.log(error)
  }
}

export async function deleteCreatedEvent(eventid) {
  let result = window.confirm('Are you sure you want to delete?')
  if (result) {
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
      console.log(result)

      getCreatedEvents()
    } catch (error) {
      console.log(error)
    }
  } else {
    // User clicked Cancel
    console.log('Action cancelled.')
  }
}
