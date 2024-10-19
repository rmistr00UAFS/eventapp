import { reactive } from 'vue'

export const globalState = reactive({
  auth: false,
  selectedCat: null,
  userid: null,
  eventid: null,
  savedEvents: [],
  selectedEvent: null,
  filteredEvents: [],
  center: { lat: 35.385803, lng: -94.403229 },
  cats: [
    {
      CA_ID: 1,
      TYPE: 'Conference',
      NAME: 'Tech Conference',
      EVENTID: 101
    },
    {
      CA_ID: 2,
      TYPE: 'Workshop',
      NAME: 'Coding Bootcamp',
      EVENTID: 102
    },
    {
      CA_ID: 3,
      TYPE: 'Seminar',
      NAME: 'AI Seminar',
      EVENTID: 103
    },
    {
      CA_ID: 4,
      TYPE: 'Meetup',
      NAME: 'Developer Meetup',
      EVENTID: 104
    },
    {
      CA_ID: 5,
      TYPE: 'Webinar',
      NAME: 'Cloud Computing Webinar',
      EVENTID: 105
    }
  ]
})
