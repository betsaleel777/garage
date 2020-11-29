/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue';
import NotificationsUser from './components/Notifications.vue'
import Toast from "vue-toastification";
const options = {
    position: "top-right",
    timeout: 5000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
}
Vue.use(Toast, options)

new Vue({
    el: '#app',
    components: {
        NotificationsUser
    }
})

