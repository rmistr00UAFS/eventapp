import { reactive } from 'vue'

export const globalState = reactive({
  auth: false,
  selectedCat: null,
  userid: null,
  eventid: null,
  savedEvents: [],
  selectedEvent: null,
  filteredEvents: []
})
