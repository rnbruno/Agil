

// require('./bootstrap');
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import {createApp, onMounted} from 'vue'
import LaravelVuePagination from 'laravel-vue-pagination';
import router from './router'
import VueSweetalert2 from "vue-sweetalert2";
import useAuth from "./composables/auth";
import { abilitiesPlugin } from '@casl/vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import vuetify from '../js/vuetify/index';
// Importar ícones específicos
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import '@fortawesome/fontawesome-free/css/all.min.css'; // Importa o CSS do Font Awesome
import { InertiaProgress } from '@inertiajs/progress';
import { createPinia } from 'pinia';

library.add(fas, fab);
import ability from './services/ability';

const pinia = createPinia();

const app = createApp({
    setup() {
        const { getUser } = useAuth()
        onMounted(getUser)
    }
})
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(pinia);
app.use(router)
app.use(VueSweetalert2)
app.use(library)
app.use(FontAwesomeIcon)
app.use(vuetify)
app.use(abilitiesPlugin, ability)
app.component('Pagination', LaravelVuePagination)
app.use(InertiaProgress);
app.mount('#app')
