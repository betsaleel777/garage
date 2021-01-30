/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import Vue from "vue";
import NotificationsUser from "./components/Notifications.vue";
import ReceptionForm from './components/receptions/ReceptionForm.vue'
import DeleteButton from "./components/DeleteButton.vue";
import ModalPreessaiAdd from "./components/preessais/ModalPreessaiAdd.vue";
import ModalPreessaiEdit from "./components/preessais/ModalPreessaiEdit.vue";
import ModalPostessaiAdd from "./components/postessais/ModalPostessaiAdd.vue";
import ModalPostessaiEdit from "./components/postessais/ModalPostessaiEdit.vue";
import FormDiagnostique from "./components/diagnostiques/FormDiagnostique.vue";
import OldIntervention from "./components/OldIntervention.vue";
import FormReparation from "./components/reparations/FormReparation.vue";
import MenuItemStock from "./components/systeme/MenuItemStock.vue";
import MenuItemReparation from "./components/systeme/MenuItemReparation.vue";
import PreviewImage from './components/PreviewImage.vue'
import StepperPiece from './components/pieces/StepperPieceAdd.vue'
import MagasinStepper from './components/magasins/MagasinStepper.vue'

import axios from "axios";
import VueAxios from "vue-axios";
import Vuelidate from 'vuelidate';
//plugins
import { ToastPlugin } from "bootstrap-vue";
import { ModalPlugin } from "bootstrap-vue";
//style
import "vue-step-wizard/dist/vue-step-wizard.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-vue/dist/bootstrap-vue.min.css";
import 'vue-select/dist/vue-select.css';

//initialisation des plugins
Vue.use(ModalPlugin);
Vue.use(ToastPlugin);
Vue.use(VueAxios, axios);

new Vue({
    el: "#app",
    components: {
        NotificationsUser,
        ReceptionForm,
        DeleteButton,
        ModalPreessaiAdd,
        ModalPreessaiEdit,
        ModalPostessaiAdd,
        ModalPostessaiEdit,
        FormDiagnostique,
        OldIntervention,
        FormReparation,
        MenuItemStock,
        MenuItemReparation,
        PreviewImage,
        StepperPiece,
        MagasinStepper
    }
});
