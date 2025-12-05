import './bootstrap';
import { createApp } from 'vue';

// 1. Import your components
import CalendarWidget from './components/CalendarWidget.vue';
import LeadsChartCard from './components/LeadsChartCard.vue'; // <--- ADD THIS

const app = createApp({});

// 2. Register them globally
app.component('calendar-widget', CalendarWidget);
app.component('leads-chart-card', LeadsChartCard); // <--- ADD THIS

// 3. Mount the app
app.mount('#app');
