/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'

window.Vue = require('vue');
import { Form, HasError, AlertError} from 'vform';
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
Vue.use(ServerTable, {}, false, 'bootstrap3');
Vue.use(ClientTable, {}, false, 'bootstrap3');
Vue.use(Event);


import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '5px'
});

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import swal from 'sweetalert2';
window.swal = swal;
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import VueRouter from 'vue-router'
window.Fire = new Vue();
Vue.use(VueRouter)
let routes = [

  { path: '/', component: require('./components/Front/Home.vue').default},

  { path: '/admin/portolio/', component: require('./components/Admin/Portofolio.vue').default, name: 'portofolio'},
  { path: '/admin/portolio/tambah', component: require('./components/Admin/TambahPorto.vue').default},

  { path: '/admin/halaman', component: require('./components/Admin/Halaman.vue').default},
  { path: '/admin/tim', component: require('./components/Admin/Tim.vue').default},
  { path: '/admin/layanan', component: require('./components/Admin/Layanan.vue').default},
  { path: '/admin/home', component: require('./components/Admin/Dashboard.vue').default},
  { path: '/admin/pengaturan', component: require('./components/Admin/Pengaturan.vue').default},

]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 const router = new VueRouter({
 	mode: 'history',
 	routes
 })

 const app = new Vue({
    el: '#app',
    router
});
