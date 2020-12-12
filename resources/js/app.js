/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import LoginComponent from "./components/Auth/LoginComponent";
import RegisterComponent from "./components/Auth/RegisterComponent";
import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import ProjectCardComponent from "./components/Projects/ProjectCardComponent";
import ProjectComponent from "./components/Projects/ProjectComponent";
import AdviceComponent from "./components/AdviceComponent"
import Recommend from './components/Projects/RecommendationsComponent'
import PurchasedProjectCardComponent from "./components/Projects/PurchasedProjectCardComponent";
import MyProjectsComponent from "./components/Projects/MyProjectsComponent";
import AddBalanceComponent from "./components/AddBalanceComponent";


Vue.use(VueRouter)
Vue.use(Vuelidate)
Vue.use(SequentialEntrance);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login', LoginComponent);
Vue.component('register', RegisterComponent);

Vue.component('project-card', ProjectCardComponent);
Vue.component('purchased-project-card', PurchasedProjectCardComponent);
Vue.component('my-projects', MyProjectsComponent);
Vue.component('project', ProjectComponent);
Vue.component('recommendations', Recommend);

Vue.component('advice', AdviceComponent);

Vue.component('add-balance', AddBalanceComponent);



const app = new Vue({
    el: '#app',
});
