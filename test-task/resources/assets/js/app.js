
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('items-list-component', require('./components/ItemsListComponent.vue'));
Vue.component('item-create-component', require('./components/ItemCreateComponent.vue'));
//
//import ItemsIndex from './components/ItemsListComponent';
// import ItemsShow from './components/ItemComponent.vue';
// import ItemCreate from './components/companies/ItemCreate.vue';
// import ItemEdit from './components/companies/ItemEdit.vue';

const app = new Vue({el: '#app'});
