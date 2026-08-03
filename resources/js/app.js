import { createApp } from "vue";
import { createPinia } from "pinia";
import { createNotivue } from "notivue";
import axios from "axios";
import App from "./App.vue";
import router from "./router";

import "notivue/notification.css";
import "notivue/animations.css";

// Create Vue app instance
const app = createApp(App);

// Create Pinia store instance
const pinia = createPinia();

// Create Notivue instance
const notivue = createNotivue({
    position: "top-right",
    limit: 4,
    notifications: {
        global: {
            duration: 3000,
        },
    },
});

// Configure axios defaults
axios.defaults.baseURL = "/api"; // Sesuaikan dengan base URL API Laravel
axios.defaults.withCredentials = true;

// Provide axios to all components
app.config.globalProperties.$http = axios;

// Use plugins
app.use(pinia);
app.use(router);
app.use(notivue);

// Mount the application
app.mount("#app");
