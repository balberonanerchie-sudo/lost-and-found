// resources/js/app.js
import './bootstrap';
import { createApp } from 'vue';

// 1. Import the components
import CalendarWidget from './components/CalendarWidget.vue';
import Chart from './components/Chart.vue'; 
const app = createApp({});

// 2. Register them globally
app.component('calendar-widget', CalendarWidget);
app.component('chart', Chart);

// 3. Mount the app
app.mount('#app');
