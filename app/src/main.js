import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import all solid icons */
import { fas } from '@fortawesome/free-solid-svg-icons'

/* add all solid icons to the library */
library.add(fas)

const app = createApp(App).use(router);

app.component('font-awesome-icon', FontAwesomeIcon)

app.mount('#app')

app.config.globalProperties.$axios = axios;
window.axios = axios;
