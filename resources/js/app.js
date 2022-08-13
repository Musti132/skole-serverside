import { createApp } from 'vue';
import vuetify from './plugins/vuetify';
import router from './router';
import axios from 'axios';
import store from '@/store';
import { loadFonts } from './plugins/webfontloader';

loadFonts()

const app = createApp({})

app.use(vuetify);
app.use(router);
app.use(store);

app.config.globalProperties.axios = axios;

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

import App from './App.vue'
app.component('App', App);


app.mount('#app');