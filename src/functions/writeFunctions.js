import { getCreatedEvents } from '../functions/readFunctions.js'
import { globalState } from './data.js'

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

export async function submitEvent() {
  globalState.event.userid = globalState.userid

  try {
    const response = await fetch('http://localhost/Write/createEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(globalState.event)
    })

    const result = await response.json()

    if (result) {
      getCreatedEvents()
    }
  } catch (error) {
    console.log(error)
  }
}

export async function updateCreatedEvent(eventid) {
  // Set the event ID and user ID
  event.eventid = eventid
  event.userid = globalState.userid

  try {
    // Wait for the coordinates to be retrieved
    await getCoordinates()
    // Then submit the updated event
    await submitUpdatedEvent()
  } catch (error) {
    console.error('Error updating event:', error)
  }
}

async function submitUpdatedEvent() {
  try {
    const response = await fetch('http://localhost/Write/updateEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(globalState.event)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    getCreatedEvents()
  } catch (error) {
    console.log(error)
  }
}

async function getCoordinates() {
  const API = 'AIzaSyBSPsKVWUUPt6WYOXw1smq-3iiy0X3P59k'
  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(globalState.event.address)}&key=${API}`

  try {
    const response = await fetch(url)
    const data = await response.json()

    if (data.status === 'OK' && data.results.length > 0) {
      const location = data.results[0].geometry.location

      // Store the coordinates as a JSON string or directly as an object
      globalState.event.coordinates = JSON.stringify(location)

      // Set the user ID for the event
      globalState.event.userid = globalState.userid

      console.log('Coordinates successfully retrieved:', location)
    } else {
      console.error('Geocoding error:', data.status, data.error_message || 'No results found.')
    }
  } catch (error) {
    console.error('Fetch error:', error)
  }
}
