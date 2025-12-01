// resources/js/app.js
import "./bootstrap"; // Or other imports you might have
import { createApp } from "vue";

const app = createApp({});

// Register any global components here if needed
// app.component('example-component', require('./components/ExampleComponent.vue').default);

app.mount("#app"); // Mount the Vue app to an element with id="app"