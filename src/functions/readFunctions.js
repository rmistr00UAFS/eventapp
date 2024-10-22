import { globalState } from './data.js'

export async function getSavedEvents() {
  try {
    const response = await fetch('http://localhost/Read/getSavedEvents.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userid: globalState.userid })
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    console.log(result)

    globalState.savedEvents = result.events
  } catch (error) {
    console.log(error)
  }
}

export async function getCreatedEvents() {
  try {
    const response = await fetch('http://localhost/Read/getCreatorEvents.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userid: globalState.userid })
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }
    const result = await response.json()
    console.log(result)

    globalState.createdEvents = result.events
  } catch (error) {
    console.log(error)
  }
}

export async function getUserDetails() {
  try {
    const response = await fetch('http://localhost/Read/getUserDetails.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userid: globalState.userid })
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }
    const result = await response.json()

    //console.log(result.events[0])
    return result.events[0]
  } catch (error) {
    console.log(error)
  }
}
