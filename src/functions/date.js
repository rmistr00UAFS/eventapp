export function date(strdate) {
  const date = new Date(strdate)
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  const formattedDate = date.toLocaleDateString('en-US', options)

  return formattedDate
}
