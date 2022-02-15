require('./bootstrap');

window.Vue = require('vue').default;


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
Vue.component('card-parameters', require('./components/CardsParameters.vue').default);
Vue.component('test-map', require('./components/Test.vue').default);

import Vue from 'vue';
import movable from "v-movable";


Vue.use(movable)

 import VueChatScroll from 'vue-chat-scroll'

 Vue.use(VueChatScroll)
const app = new Vue({
    el: '#app',
});
