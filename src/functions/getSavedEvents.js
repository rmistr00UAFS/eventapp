export async function getSavedEvents(userid) {
  try {
    const response = await fetch('http://localhost/Read/getSavedEvents.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ userid })
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    //go to login state
    return result
  } catch (error) {
    console.log(error)
  }
}
