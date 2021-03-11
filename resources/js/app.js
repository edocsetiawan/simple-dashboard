require('./bootstrap');
import Vue from 'vue'

import VueRouter from 'vue-router';
import App from './App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

import HomePageComponent from './Components/homepage.vue';
import LandingComponent from './Components/landingpage.vue';
import RegisterComponent from './Components/registerpage.vue';
import EditComponent from './Components/editpage.vue';

const routes = [
    {
        name : 'homepage',
        path: '/',
        component : HomePageComponent
    },
    {
        name : 'landingpage',
        path: '/landingpage',
        component : LandingComponent
    },
    {
        name : 'registerpage',
        path: '/registerpage',
        component : RegisterComponent
    },
    {
        name: 'editpage',
        path: '/edit-page', 
        props: true,
        component: EditComponent
    },

]
const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');