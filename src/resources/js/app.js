/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from "vue";
import Toast, { PluginOptions, POSITION } from 'vue-toastification';

import vuex from './store.js';
import router from './routes/router.js';

const app = createApp({
    components: {},
});

app.use(vuex)
app.use(router)

const options = {
    position: POSITION.TOP_RIGHT,
};
app.use(Toast, options)

app.mount('#app')
