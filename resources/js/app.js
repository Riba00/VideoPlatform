import Alpine from 'alpinejs';
import Vue from 'vue/dist/vue.js';
import casteaching from "@acacha/casteaching";

import './bootstrap';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";
import Status from "./components/Status.vue";
import Notification from "./components/Notification.vue";


window.Alpine = Alpine;

const api = casteaching({baseUrl: import.meta.env.VITE_API_URL});
api.setToken('sszyRVEZqpROZjFyG6MZ5EVqnJDGDcLOc11uC8n4')
window.casteaching = api;
Alpine.start();

window.Vue = Vue;

window.Vue.component('videos-list',VideosList);
window.Vue.component('video-form',VideoForm);
window.Vue.component('status',Status);
window.Vue.component('notification',Notification);

const app = new window.Vue({
    el: '#vueapp',
});
