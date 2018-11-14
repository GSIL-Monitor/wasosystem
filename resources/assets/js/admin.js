
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
import iView from 'iview';
import 'iview/dist/styles/iview.css';
//import Distpicker from 'v-distpicker'
import VueDND from 'awe-dnd';
Vue.use(VueDND)
Vue.use(iView);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('upload-images', require('./components/UploadImagesComponent.vue'));
Vue.component('transfer', require('./components/TransferComponent.vue'));
Vue.component('select2', require('./components/SelectComponent.vue'));
Vue.component('datePicker-filtrate', require('./components/DatePickerFiltrate.vue'));

//Vue.component('v-distpicker', Distpicker) 地址选择器   现在选用仿京东选择器
// const app = new Vue({
//     el: '#app'
// });
