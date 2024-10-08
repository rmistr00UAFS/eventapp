// utils/dateUtils.js

export function date() {
  const today = new Date()

  // Get the day of the month
  const day = today.getDate()

  // Get the name of the day
  const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
  const dayName = daysOfWeek[today.getDay()]

  // Get the name of the month
  const monthsOfYear = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ]
  const monthName = monthsOfYear[today.getMonth()]

  return `${dayName}, ${monthName} ${day}`
}
