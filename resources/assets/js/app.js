
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Autocomplete from 'v-autocomplete'
import 'v-autocomplete/dist/v-autocomplete.css'
require('./bootstrap');



window.Vue = require('vue');

// You need a specific loader for CSS files like https://github.com/webpack/css-loader

Vue.use(Autocomplete)

Vue.component('pagination', require('laravel-vue-pagination'));


Vue.component('example', require('./components/Example.vue'));
Vue.component('enquirytable', require('./components/EnquiryTable.vue'));
Vue.component('articleCreate', require('./components/articles/create.vue'));
Vue.component('articleList', require('./components/articles/list.vue'));
Vue.component('articleEdit', require('./components/articles/edit.vue'));
Vue.component('applicationView', require('./components/application/view/view.vue'));
Vue.component('agentapplicationView', require('./components/agentapplication/view/view.vue'));
Vue.component('courseShortlist', require('./components/course/shortlist/listing.vue'));
Vue.component('registrationForm', require('./components/registration_form/form.vue'));
Vue.component('document-upload', require('./components/documents/upload.vue'));

const app = new Vue({
    el: '#app'
});
