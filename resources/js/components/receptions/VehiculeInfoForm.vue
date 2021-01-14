<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <div class="form-group input-group">
                        <input
                            type="text"
                            name="immatriculation"
                            v-model="immatriculation"
                            class="form-control"
                            id="immatriculation"
                            placeholder="plaque d'immatriculation"
                        />
                        <span class="input-group-append">
                            <button
                                @click="check"
                                type="button"
                                class="btn btn-primary btn-flat"
                            >
                                ok
                            </button>
                        </span>
                        <datalist id="matricule">
                            <option
                                v-for="matricule in immatriculations"
                                :key="matricule"
                                >{{ matricule }}</option
                            >
                        </datalist>
                        <span
                            v-if="messages.immatriculation.exist"
                            class="text-danger"
                            >{{ messages.immatriculation.value }}</span
                        >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="chassis">Chassis</label>
                    <input
                        name="chassis"
                        v-model="chassis"
                        class="form-control"
                        id="chassis"
                    />
                    <span v-if="messages.chassis.exist" class="text-danger">{{
                        messages.chassis.value
                    }}</span>
                </div>
            </div>
        </div>
        <div class=" form-group row">
            <div class="col-3">
                <label for="marque">Marque</label>
                <input
                    name="marque"
                    v-model="marque"
                    id="marque"
                    type="text"
                    class="form-control"
                    placeholder="audi"
                />
                <small>
                    <span v-if="messages.marque.exist" class="text-danger">{{
                        messages.marque.value
                    }}</span>
                </small>
            </div>
            <div class="col-2">
                <label for="modele">Modèle</label>
                <input
                    name="modele"
                    v-model="modele"
                    id="modele"
                    type="text"
                    class="form-control"
                    placeholder="A6"
                />
                <small>
                    <span v-if="messages.modele.exist" class="text-danger">{{
                        messages.modele.value
                    }}</span>
                </small>
            </div>
            <div class="col-3">
                <label for="type_vehicule">Type</label>
                <input
                    type="text"
                    list="vehicule_type"
                    name="type_vehicule"
                    v-model="type_vehicule"
                    class="form-control"
                    id="type_vehicule"
                    placeholder="type"
                />
                <datalist id="vehicule_type">
                    <option v-for="type in types_vehicules" :key="type">{{
                        type
                    }}</option>
                </datalist>
                <small>
                    <span
                        v-if="messages.type_vehicule.exist"
                        class="text-danger"
                        >{{ messages.type_vehicule.value }}</span
                    >
                </small>
            </div>
            <div class="col-2">
                <label for="annee">Année</label>
                <input
                    name="annee"
                    v-model="annee"
                    id="annee"
                    type="text"
                    class="form-control"
                    placeholder="2012"
                />
                <small>
                    <span v-if="messages.annee.exist" class="text-danger">{{
                        messages.annee.value
                    }}</span>
                </small>
            </div>
            <div class="col-2">
                <label for="couleur">Couleur</label>
                <input
                    name="couleur"
                    v-model="couleur"
                    id="couleur"
                    type="text"
                    class="form-control"
                    placeholder="orange"
                />
                <small>
                    <span v-if="messages.couleur.exist" class="text-danger">{{
                        messages.couleur.value
                    }}</span>
                </small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        immatriculations: Array,
        types_vehicules: Array,
        old: {
            type: [Array, Object]
        },
        errors: {
            type: [Array, Object]
        }
    },
    data() {
        return {
            immatriculation: null,
            modele: null,
            type_vehicule: null,
            marque: null,
            annee: null,
            couleur: null,
            chassis: null,
            messages: {
                immatriculation: {
                    exist: false,
                    value: null
                },
                modele: {
                    exist: false,
                    value: null
                },
                type_vehicule: {
                    exist: false,
                    value: null
                },
                marque: {
                    exist: false,
                    value: null
                },
                annee: {
                    exist: false,
                    value: null
                },
                couleur: {
                    exist: false,
                    value: null
                },
                chassis: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    mounted() {
        console.log(this.old, this.errors);
        this.erreurs();
        this.anciens();
    },
    methods: {
        check() {
            axios
                .get("/systeme/async/vehicule/find/" + this.immatriculation)
                .then(result => {
                    const { vehicule } = result.data;
                    if (vehicule) {
                        this.immatriculation = vehicule.immatriculation;
                        this.modele = vehicule.modele;
                        this.marque = vehicule.marque;
                        this.annee = vehicule.annee;
                        this.couleur = vehicule.couleur;
                        this.chassis = vehicule.chassis;
                        this.type_vehicule = vehicule.type_vehicule;
                        this.$bvToast.toast(
                            "Un véhicule correspondant a été retrouvé",
                            {
                                title: "OPERATION REUSSIE",
                                solid: true,
                                variant: "info"
                            }
                        );
                    } else {
                        this.vider();
                        this.$bvToast.toast(
                            "Aucun véhicule ne correspond à la description",
                            {
                                title: "OPERATION REUSSIE",
                                solid: true,
                                variant: "warning"
                            }
                        );
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        erreurs() {
            if (this.errors.immatriculation) {
                this.messages.immatriculation.exist = true;
                this.messages.immatriculation.value = this.errors.immatriculation;
            }
            if (this.errors.modele) {
                this.messages.modele.exist = true;
                this.messages.modele.value = this.errors.modele;
            }
            if (this.errors.chassis) {
                this.messages.chassis.exist = true;
                this.messages.chassis.value = this.errors.chassis;
            }
            if (this.errors.couleur) {
                this.messages.couleur.exist = true;
                this.messages.couleur.value = this.errors.couleur;
            }
            if (this.errors.type_vehicule) {
                this.messages.type_vehicule.exist = true;
                this.messages.type_vehicule.value = this.errors.type_vehicule;
            }
            if (this.errors.marque) {
                this.messages.marque.exist = true;
                this.messages.marque.value = this.errors.marque;
            }
            if (this.errors.annee) {
                this.messages.annee.exist = true;
                this.messages.annee.value = this.errors.annee;
            }
        },
        anciens() {
            if (this.errors.immatriculation) {
                this.immatriculation = this.old.immatriculation;
            }
            if (this.errors.modele) {
                this.modele = this.old.modele;
            }
            if (this.errors.chassis) {
                this.chassis = this.old.chassis;
            }
            if (this.errors.couleur) {
                this.couleur = this.old.couleur;
            }
            if (this.errors.type_vehicule) {
                this.type_vehicule = this.old.type_vehicule;
            }
            if (this.errors.marque) {
                this.marque = this.old.marque;
            }
            if (this.errors.annee) {
                this.annee = this.old.annee;
            }
        },
        vider() {
            this.modele = null;
            this.marque = null;
            this.annee = null;
            this.couleur = null;
            this.chassis = null;
            this.type_vehicule = null;
        }
    }
};
</script>

<style></style>
