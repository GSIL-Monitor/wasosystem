
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
import iView from 'iview';
// import '../styles/iview.css'
//import Distpicker from 'v-distpicker'
import VueDND from 'awe-dnd';
import VeeValidate , { Validator }from 'vee-validate';
import zh from './zh_CN'
import "babel-polyfill";
Vue.use(VueDND)
Vue.use(iView);
Validator.localize('zh_CN', zh);
Vue.use(VeeValidate, {
    locale: 'zh_CN',
    fieldsBagName: 'fieldBags',
});
//手机号验证规则(可在所有组件中使用)
Validator.extend('mobile', {
    getMessage: field => field + '格式不正确',
    validate: (value, args) => {
        return value.length == 11 && /^((13|14|15|17|18)[0-9]{1}\d{8})$/.test(value)
    }
});
//邮箱电话验证唯一
Validator.extend('number_unique', {
    getMessage: field => field + '已存在！',
    validate: value => {
        return axios.post('/binding_authorization/check_number', {
            '_token': getToken(),
            'number': value,
        }).then(function (response) {
            return {
                valid: true,
            };
        }).catch(function (err) {
            return {
                valid: false,
            };
        });
    }
});
//邮箱电话验证是否存在
Validator.extend('number_exists', {
    getMessage: field => field + '不存在！',
    validate: value => {
        return axios.post('/binding_authorization/check_number', {
            '_token': getToken(),
            'number': value,
        }).then(function (response) {
            return {
                valid: false,
            };
        }).catch(function (err) {
            return {
                valid: true,
            };
        });
    }
});
//验证验证码是否正确
Validator.extend('check_code', {
    getMessage: field => field + '不正确！',
    validate: (value,args) => {
        return axios.post('/binding_authorization/check_code', {
            '_token': getToken(),
            'code': value,
            'code_name': args[0],
        }).then(function (response) {
            return {
                valid: true,
            };
        }).catch(function (err) {
            return {
                valid: false,
            };
        });
    }
});
//验证码验证

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('upload-files', require('./components/UploadFilesComponent.vue'));
Vue.component('upload-images', require('./components/UploadImagesComponent.vue'));
Vue.component('transfer', require('./components/TransferComponent.vue'));
Vue.component('select2', require('./components/SelectComponent.vue'));
Vue.component('good-remote-select', require('./components/GoodRemoteSelect.vue'));
Vue.component('date-picker-filtrate', require('./components/DatePickerFiltrate.vue'));
Vue.component('date-picker-select', require('./components/DatePicker.vue'));
Vue.component('material_editor', require('./components/MaterialEditor.vue'));
//Vue.component('v-distpicker', Distpicker) 地址选择器   现在选用仿京东选择器
// const app = new Vue({
//     el: '#app'
// });
