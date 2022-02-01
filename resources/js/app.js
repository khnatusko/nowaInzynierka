/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('game-component', require('./components/CreateSessionGame.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default);
Vue.component('card-component', require('./components/CreateCard.vue').default);
Vue.component('parameters-component', require('./components/CreateParameters.vue').default);
Vue.component('profile-component', require('./components/ProfileDetails.vue').default);
Vue.component('list-component', require('./components/UserList.vue').default);
Vue.component('sessiongame-component', require('./components/SessionGame.vue').default);
Vue.component('user-card', require('./components/UserCards.vue').default);

import Vue from 'vue';
import movable from "v-movable";


Vue.use(movable)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import VueChatScroll from 'vue-chat-scroll'

 Vue.use(VueChatScroll)
const app = new Vue({
    el: '#app',
});
