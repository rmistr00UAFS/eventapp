import { globalState } from '../functions/data.js'

export function timeConvert(time) {
  const [hours, minutes, seconds] = time.split(':')
  const date = new Date()
  date.setHours(hours, minutes, seconds)

  return date
    .toLocaleTimeString('en-US', {
      hour: 'numeric',
      minute: 'numeric',
      hour12: true
    })
    .toUpperCase() // Convert to "AM" or "PM"
}

export function getCatName(id) {
  const cat = globalState.cats.find((x) => x.CA_ID == id)
  return cat ? cat.NAME : '?'
}
