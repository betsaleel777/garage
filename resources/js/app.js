/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue';
import NotificationsUser from './components/Notifications.vue'
import ClientForm from './components/receptions/ClientForm.vue'
import { ToastPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(ToastPlugin)

new Vue({
    el: '#app',
    components: {
        NotificationsUser,
        ClientForm
    }
})

