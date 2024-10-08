import { createApp } from 'vue'
import App from './App.vue'
import './style.css'

import router from './routes';
import { createPinia } from 'pinia';
import Toast, { POSITION } from 'vue-toastification';
import VueTheMask from 'vue-the-mask';
import "vue-toastification/dist/index.css";


const app = createApp(App);
const pinia = createPinia();

app.use(pinia);
app.use(router);
app.use(Toast, {
  position: POSITION.TOP_RIGHT
});
app.use(VueTheMask);
app.mount('#app');
