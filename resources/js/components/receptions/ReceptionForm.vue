<template>
    <form enctype="multipart/form-data" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div style="margin-bottom: 3%">
                    <h5 class="text-primary">Informations du client</h5>
                    <hr />
                    <client-form></client-form>
                </div>
            </div>
            <div class="col-md-12">
                <ancien-vehicule-form :errors="erreurs" />
            </div>
            <div class="col-md-12">
                <h5 class="text-primary">Informations du véhicule</h5>
                <hr />
                <vehicule-form :errors="erreurs" />
            </div>
            <!-- checklist -->
            <checklist-form :errors="erreurs" />
            <commentaire-reception :errors="erreurs" />
        </div>
        <div style="text-align: right" class="form-group">
            <button @click="envoyer" type="button" class="btn btn-primary">
                enregistrer
            </button>
        </div>
    </form>
</template>

<script>
import ClientForm from "./ClientForm";
import AncienVehiculeForm from "./AncienVehiculeForm";
import VehiculeForm from "./VehiculeInfoForm";
import ChecklistForm from "./ChecklistForm";
import CommentaireReception from "./CommentaireReceptionForm";
import Store from "./Store";
export default {
    components: {
        ClientForm,
        AncienVehiculeForm,
        VehiculeForm,
        ChecklistForm,
        CommentaireReception
    },
    data() {
        return {
            erreurs: {}
        };
    },
    methods: {
        envoyer() {
            axios
                .post("/maintenance/reception/store")
                .then(result => {})
                .catch(err => {
                    const { errors } = err.data.response;
                    this.erreurs = errors;
                });
        }
    }
};
</script>

<style></style>
