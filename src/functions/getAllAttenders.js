export async function getAllAttenders(id) {
  let data = {
    eventid: id
  }

  try {
    const response = await fetch('http://localhost/Read/getAllAttenders.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    console.log(result)

    return result
  } catch (error) {
    console.log(error)
  }
}
