<script setup>
import { ref, reactive } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'

// --- Utility Functions ---
const addDays = (date, days) => {
  const result = new Date(date)
  result.setDate(result.getDate() + days)
  return result
}

const formatDate = (dateObj) => {
  return dateObj.toLocaleDateString('en-GB', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  })
}

// --- State Management ---
const today = new Date()
const isModalOpen = ref(false)
const modalTitle = ref('')
const eventTitle = ref('')
const selectedDateInfo = ref(null) // Stores the info from date selection
const selectedEvent = ref(null) // Stores the event if editing an existing one

// --- Initial Events Data ---
const initialEvents = [
  { title: 'Past Event', start: addDays(today, -2).toISOString().split('T')[0], classNames: ['fc-event-info'] },
  { title: 'All Day Event', start: addDays(today, 2).toISOString().split('T')[0], classNames: ['fc-event-info'] },
  { title: 'Long Event', start: addDays(today, 2).toISOString().split('T')[0], end: addDays(today, 5).toISOString().split('T')[0], classNames: ['fc-event-primary'] },
  { title: 'Confirm tech stack', start: addDays(today, 0).toISOString().split('T')[0] + 'T10:00:00', end: addDays(today, 0).toISOString().split('T')[0] + 'T18:00:00', classNames: ['fc-event-success'] },
  { groupId: '999', title: 'Coding session', start: addDays(today, 1).toISOString().split('T')[0] + 'T16:00:00', classNames: ['fc-event-secondary'] },
  { groupId: '999', title: 'Coding session', start: addDays(today, 8).toISOString().split('T')[0] + 'T16:00:00', classNames: ['fc-event-secondary'] },
  { title: 'Conference', start: addDays(today, 9).toISOString().split('T')[0], end: addDays(today, 10).toISOString().split('T')[0], classNames: ['fc-event-primary'] },
  { title: 'Meeting', start: addDays(today, 9).toISOString().split('T')[0] + 'T10:30:00', end: addDays(today, 9).toISOString().split('T')[0] + 'T12:30:00', classNames: ['fc-event-error'] },
  { title: 'Lunch', start: addDays(today, 9).toISOString().split('T')[0] + 'T12:40:00', classNames: ['fc-event-warning'] },
  { title: 'Meeting', start: addDays(today, 9).toISOString().split('T')[0] + 'T14:30:00', classNames: ['fc-event-error'] },
  { title: 'Picnic', start: addDays(today, 12).toISOString().split('T')[0], classNames: ['fc-event-success'] },
  { title: 'Yoga', start: addDays(today, 15).toISOString().split('T')[0], classNames: ['fc-event-info'] },
  { title: 'Credit Card Payment', start: addDays(today, 23).toISOString().split('T')[0], end: addDays(today, 24).toISOString().split('T')[0], classNames: ['fc-event-warning'] },
  { title: 'Meeting with client', start: addDays(today, 27).toISOString().split('T')[0], classNames: ['fc-event-success'] },
  // Blocked range background event
  { 
    start: addDays(today, 17).toISOString().split('T')[0], 
    end: addDays(today, 20).toISOString().split('T')[0], 
    display: 'background', 
    classNames: ['fc-event-disabled'] 
  }
]

// --- Event Handlers ---

// Handle clicking on a date (empty slot)
const handleDateSelect = (selectInfo) => {
  // Blocked Date Logic
  const blockedStart = addDays(today, 17).getTime()
  const blockedEnd = addDays(today, 20).getTime()
  const selectedStart = selectInfo.start.getTime()
  const selectedEnd = selectInfo.end ? selectInfo.end.getTime() : selectedStart

  // Check overlap
  if (
    (selectedStart < blockedEnd && selectedEnd > blockedStart) ||
    (selectedEnd > blockedStart && selectedStart < blockedEnd)
  ) {
    alert('Events cannot be added in the blocked date range.')
    selectInfo.view.calendar.unselect() // Clear selection
    return
  }

  // Open Modal for New Event
  selectedEvent.value = null // New event mode
  selectedDateInfo.value = selectInfo
  modalTitle.value = formatDate(selectInfo.start)
  eventTitle.value = '' // Reset form
  isModalOpen.value = true
}

// Handle clicking an existing event
const handleEventClick = (clickInfo) => {
  // Open Modal for Edit
  selectedEvent.value = clickInfo.event
  modalTitle.value = formatDate(clickInfo.event.start)
  eventTitle.value = clickInfo.event.title
  isModalOpen.value = true
}

// Save the event (Add or Update)
const saveEvent = () => {
  if (eventTitle.value) {
    const calendarApi = selectedDateInfo.value?.view?.calendar || selectedEvent.value?.source?.calendar

    if (selectedEvent.value) {
      // Update existing
      selectedEvent.value.setProp('title', eventTitle.value)
    } else if (selectedDateInfo.value) {
      // Create new
      calendarApi.addEvent({
        title: eventTitle.value,
        start: selectedDateInfo.value.startStr,
        end: selectedDateInfo.value.endStr,
        allDay: selectedDateInfo.value.allDay
      })
    }
    closeModal()
  }
}

const closeModal = () => {
  isModalOpen.value = false
  selectedDateInfo.value = null
  selectedEvent.value = null
}

// --- FullCalendar Configuration ---
const calendarOptions = reactive({
  plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
  initialView: 'dayGridMonth',
  initialDate: today.toISOString().split('T')[0],
  headerToolbar: {
    left: 'prev,next title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
  },
  buttonText: {
    month: 'Month',
    week: 'Week',
    day: 'Day',
    list: 'List'
  },
  editable: true,
  selectable: true,
  selectMirror: true,
  dayMaxEvents: 2,
  weekends: true,
  events: initialEvents,
  select: handleDateSelect,
  eventClick: handleEventClick,
  eventTimeFormat: {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false
  }
})
</script>

<template>
  <div class="w-full p-4">
    <!-- Calendar Container -->
    <div class="card flex not-prose w-full bg-white p-4 shadow-sm rounded-xl">
      <FullCalendar :options="calendarOptions" />
    </div>

    <!-- Modal Backdrop & Container -->
    <div v-if="isModalOpen" class="fixed inset-0 z-[60] overflow-y-auto overflow-x-hidden bg-gray-900/50 flex items-center justify-center">
      
      <!-- Modal Dialog -->
      <div class="relative w-full max-w-md p-4">
        <div class="relative bg-white rounded-xl shadow-lg dark:bg-gray-800">
          
          <!-- Header -->
          <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">
              {{ modalTitle }}
            </h3>
            <button @click="closeModal" type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600">
              <span class="sr-only">Close</span>
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
          </div>

          <!-- Body -->
          <div class="p-4">
            <form @submit.prevent="saveEvent">
              <div class="mb-4">
                <label for="eventTitle" class="block text-sm font-medium mb-2 dark:text-white">
                  Add event title below
                </label>
                <input 
                  v-model="eventTitle"
                  type="text" 
                  id="eventTitle" 
                  class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                  placeholder="Event title" 
                  required 
                />
              </div>

              <!-- Footer -->
              <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-gray-700">
                <button @click="closeModal" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                  Close
                </button>
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                  Save changes
                </button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<style>
/* FullCalendar Override classes if needed to match your Forest Green theme */
/* You can customize the event colors here based on the classNames in your data */

.fc-event-success {
  background-color: #10b981; /* Green */
  border-color: #10b981;
}
.fc-event-primary {
  background-color: #3b82f6; /* Blue */
  border-color: #3b82f6;
}
.fc-event-disabled {
  background-color: #e5e7eb; /* Gray */
  border-color: #e5e7eb;
  opacity: 0.6;
}
</style>
