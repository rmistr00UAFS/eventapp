export async function saveEvent(userid, eventid) {
  let save = {
    userid,
    eventid
  }
  try {
    const response = await fetch('http://localhost/Write/createSavedEvent.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(save)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()

    console.log(result)
  } catch (error) {
    console.log(error)
  }
}
