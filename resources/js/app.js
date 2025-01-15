import './bootstrap';
import { createApp } from 'vue';
import app from './components/app.vue';
import { router, store } from './router/index.js'; // Import both router and store

createApp(app)
  .use(router) // Use the router
  .use(store) // Use the Vuex store
  .mount("#app");
