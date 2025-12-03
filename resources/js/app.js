// resources/js/app.js
import './bootstrap';
import { createApp } from 'vue';

// 1. Import the component
import CalendarWidget from './components/CalendarWidget.vue';

const app = createApp({});

// 2. Register it globally
app.component('calendar-widget', CalendarWidget);

// 3. Mount the app (make sure this matches the ID in your layout)
app.mount('#app');