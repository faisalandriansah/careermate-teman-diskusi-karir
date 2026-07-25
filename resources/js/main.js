import { createApp } from 'vue';
import { createPinia } from 'pinia';
import axios from 'axios';
import App from './App.vue';
import router from './router';

// Create Vue app instance
const app = createApp(App);

// Create Pinia store instance
const pinia = createPinia();

// Configure axios defaults
axios.defaults.baseURL = '/api'; // Sesuaikan dengan base URL API Laravel
axios.defaults.withCredentials = true;

// Provide axios to all components
app.config.globalProperties.$http = axios;

// Use plugins
app.use(pinia);
app.use(router);

// Mount the application
app.mount('#app');