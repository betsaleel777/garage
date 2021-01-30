<template>
    <form>
        <div class="form-group">
            <label for="nom">Nom complet</label>
            <input
                v-model="formData.nom"
                name="nom"
                class="form-control"
                :class="hasError('nom') ? 'is-invalid' : ''"
                id="nom"
            />
            <div v-if="hasError('nom')" class="invalid-feedback">
                Le nom est requis
            </div>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input
                v-model="formData.lieu"
                name="lieu"
                class="form-control"
                :class="hasError('lieu') ? 'is-invalid' : ''"
                id="lieu"
            />
            <div v-if="hasError('lieu')" class="invalid-feedback">
                le lieu d'installation du magasin est requis
            </div>
        </div>
    </form>
</template>

<script>
import { ValidationHelper } from "vue-step-wizard";
import { required } from "vuelidate/lib/validators";
import store from "./store";
export default {
    mixins: [ValidationHelper],
    data() {
        return {
            formData: {
                nom: null,
                lieu: null
            },
            validationRules: [{ nom: { required }, lieu: { required } }]
        };
    },
    updated() {
        store.state.nom = this.formData.nom;
        store.state.lieu = this.formData.lieu;
    },
    mounted() {},
    methods: {}
};
</script>

<style></style>
