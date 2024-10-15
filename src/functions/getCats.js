export async function getCats(userid) {
  try {
    const response = await fetch('http://localhost/Read/getCategories.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify()
    })

    // Check if the response is OK (status in the range 200-299)
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`)
    }

    const result = await response.json()
    return result
  } catch (error) {
    console.log(error)
  }
}
