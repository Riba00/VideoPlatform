import Alpine from 'alpinejs';
import casteaching from 'casteaching';
import Vue from 'vue/dist/vue.js';

import './bootstrap';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";

window.Alpine = Alpine;
window.casteaching = casteaching;
Alpine.start();

window.Vue = Vue;

window.Vue.component('videos-list',VideosList);
window.Vue.component('video-form',VideoForm);

const app = new window.Vue({
    el: '#vueapp',
});
