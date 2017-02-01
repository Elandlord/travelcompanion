import './bootstrap';
import VueRouter from 'vue-router';
require('./Core/Classes');
Vue.component('search-bar', require('./components/Search.vue'));
Vue.component('map-planner', require('./components/map-planner.vue'));
Vue.component('search-results', require('./components/SearchResults.vue'));
import router from './routes';

new Vue({
    el: '#app',

    router
});
