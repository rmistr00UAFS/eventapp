export async function getAllEventsByDay(day) {
  let data = {
    date: day
  }

  try {
    const response = await fetch('http://localhost/Read/getallEventsbyDay.php', {
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

    result.events?.map((x) => {
      x.COORDINATES = JSON.parse(x.COORDINATES)
    })

    console.log(result)

    return result
  } catch (error) {
    console.log(error)
  }
}
