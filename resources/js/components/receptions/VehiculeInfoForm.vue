<template>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="nom_deposant">Nom du déposant</label>
            <input
                v-model="infos.nom_deposant"
                class="form-control form-control-sm"
                id="nom_deposant"
            />
            <small>
                <span v-if="messages.nom_deposant.exist" class="text-danger"
                    >{{ messages.nom_deposant.value }}
                </span>
            </small>
        </div>
        <div class="form-group col-md-4">
            <label for="dmc">DMC</label>
            <input
                v-model="infos.dmc"
                class="form-control form-control-sm"
                id="dmc"
            />
            <small>
                <span v-if="messages.dmc.exist" class="text-danger"
                    >{{ messages.dmc.value }}
                </span>
            </small>
        </div>
        <div class="form-group col-md-4">
            <label>Enjoliveur</label><br />
            <div
                v-for="element in enjoliveurs"
                :key="element.id"
                class="form-check form-check-inline"
            >
                <input
                    class="form-check-input"
                    type="checkbox"
                    :id="`en${element.id}`"
                    :value="element.id"
                    v-model="infos.enjoliveur"
                />
                <label class="form-check-label" :for="`en${element.id}`"
                    >{{ element.nom }}
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="immatriculation">Immatriculation</label>
                <div class="form-group">
                    <input
                        type="text"
                        v-model="infos.immatriculation"
                        class="form-control form-control-sm"
                        id="immatriculation"
                        placeholder="plaque d'immatriculation"
                    />
                    <small>
                        <span
                            v-if="messages.immatriculation.exist"
                            class="text-danger"
                            >{{ messages.immatriculation.value }}</span
                        >
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="chassis">Chassis</label>
                <input
                    v-model="infos.chassis"
                    class="form-control form-control-sm"
                    id="chassis"
                />
                <small>
                    <span v-if="messages.chassis.exist" class="text-danger">{{
                        messages.chassis.value
                    }}</span>
                </small>
            </div>
        </div>
        <div class="col-md-3">
            <label for="marque">Marque</label>
            <input
                v-model="infos.marque"
                id="marque"
                type="text"
                class="form-control form-control-sm"
                placeholder="audi"
            />
            <small>
                <span v-if="messages.marque.exist" class="text-danger">{{
                    messages.marque.value
                }}</span>
            </small>
        </div>
        <div class="col-md-2">
            <label for="modele">Modèle</label>
            <input
                v-model="infos.modele"
                id="modele"
                type="text"
                class="form-control form-control-sm"
                placeholder="A6"
            />
            <small>
                <span v-if="messages.modele.exist" class="text-danger">{{
                    messages.modele.value
                }}</span>
            </small>
        </div>
        <div class="col-md-3">
            <label for="type_vehicule">Type</label>
            <vue-select
                :options="types_vehicules"
                v-model="infos.type_vehicule"
                id="type_vehicule"
                ><option v-for="type in types_vehicules" :key="type">{{
                    type
                }}</option>
            </vue-select>
            <small>
                <span v-if="messages.type_vehicule.exist" class="text-danger">{{
                    messages.type_vehicule.value
                }}</span>
            </small>
        </div>
        <div class="col-md-2">
            <label for="annee">Année</label>
            <input
                v-model="infos.annee"
                id="annee"
                type="text"
                class="form-control form-control-sm"
                placeholder="2012"
            />
            <small>
                <span v-if="messages.annee.exist" class="text-danger">{{
                    messages.annee.value
                }}</span>
            </small>
        </div>
        <div class="col-md-2">
            <label for="couleur">Couleur</label>
            <input
                v-model="infos.couleur"
                id="couleur"
                type="text"
                class="form-control form-control-sm"
                placeholder="orange"
            />
            <small>
                <span v-if="messages.couleur.exist" class="text-danger">{{
                    messages.couleur.value
                }}</span>
            </small>
        </div>
        <div class="form-group col-md-4">
            <label for="kilometrage_actuel">Kilometrage Actuel</label>
            <input
                v-model="infos.kilometrage_actuel"
                class="form-control form-control-sm"
                id="kilometrage_actuel"
            />
            <small>
                <span
                    v-if="messages.kilometrage_actuel.exist"
                    class="text-danger"
                    >{{ messages.kilometrage_actuel.value }}
                </span>
            </small>
        </div>
        <div class="form-group col-md-4">
            <label for="prochaine_vidange">Prochaine Vidange</label>
            <input
                v-model="infos.prochaine_vidange"
                class="form-control form-control-sm"
                id="prochaine_vidange"
            />
            <small>
                <span
                    v-if="messages.prochaine_vidange.exist"
                    class="text-danger"
                    >{{ messages.prochaine_vidange.value }}
                </span>
            </small>
        </div>
        <div class="form-group col-md-4">
            <label>Niveau de carburant</label><br />
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input"
                    type="radio"
                    v-model="infos.niveau_carburant"
                    id="ca1"
                    value="0"
                />
                <label class="form-check-label" for="ca1">0</label>
            </div>
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input"
                    type="radio"
                    v-model="infos.niveau_carburant"
                    id="ca2"
                    value="1/4"
                />
                <label class="form-check-label" for="ca2">1/4</label>
            </div>
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input"
                    type="radio"
                    v-model="infos.niveau_carburant"
                    id="ca3"
                    value="1/2"
                />
                <label class="form-check-label" for="ca3">1/2</label>
            </div>
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input"
                    type="radio"
                    v-model="infos.niveau_carburant"
                    id="ca4"
                    value="3/4"
                />
                <label class="form-check-label" for="ca4">3/4</label>
            </div>
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input"
                    type="radio"
                    v-model="infos.niveau_carburant"
                    id="ca5"
                    value="1"
                />
                <label class="form-check-label" for="ca5">1</label>
            </div>
            <small>
                <span v-if="messages.niveau_carburant.exist" class="text-danger"
                    >{{ messages.niveau_carburant.value }}
                </span>
            </small>
        </div>
        <div class="form-group col-md-6">
            <label for="date_sitca">Date de dernière visite technique</label
            ><br />
            <date-picker
                style="width:100%"
                input-class="form-control form-control-sm"
                id="date_sitca"
                v-model="infos.date_sitca"
                format="DD-MM-YYYY"
                value-type="date"
            ></date-picker>
            <small>
                <span v-if="messages.date_sitca.exist" class="text-danger"
                    >{{ messages.date_sitca.value }}
                </span>
            </small>
        </div>
        <div class="form-group col-md-6">
            <label for="date_assurance">Date de fin de l'assurance</label><br />
            <date-picker
                style="width:100%"
                input-class="form-control form-control-sm"
                id="date_assurance"
                v-model="infos.date_assurance"
                format="DD-MM-YYYY"
                value-type="date"
            ></date-picker>
            <small>
                <span v-if="messages.date_assurance.exist" class="text-danger"
                    >{{ messages.date_assurance.value }}
                </span>
            </small>
        </div>
    </div>
</template>

<script>
import store from "./Store";
import DatePicker from "vue2-datepicker";
import VueSelect from "vue-select";
import "vue2-datepicker/index.css";
import "vue-select/dist/vue-select.css";
export default {
    components: { DatePicker, VueSelect },
    props: {
        types_vehicules: Array,
        enjoliveurs: {
            type: [Array, Object]
        }
    },
    data() {
        return {
            errors: {},
            infos: {
                dmc: null,
                nom_deposant: null,
                immatriculation: null,
                modele: null,
                type_vehicule: null,
                marque: null,
                annee: null,
                couleur: null,
                chassis: null,
                kilometrage_actuel: null,
                prochaine_vidange: null,
                date_sitca: "",
                date_assurance: "",
                niveau_carburant: null,
                enjoliveur: []
            },
            messages: {
                nom_deposant: {
                    exist: false,
                    value: null
                },
                dmc: {
                    exist: false,
                    value: null
                },
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
                },
                kilometrage_actuel: {
                    exist: false,
                    value: null
                },
                prochaine_vidange: {
                    exist: false,
                    value: null
                },
                date_sitca: {
                    exist: false,
                    value: null
                },
                date_assurance: {
                    exist: false,
                    value: null
                },
                niveau_carburant: {
                    exist: false,
                    value: null
                },
                prochaine_vidange: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    mounted() {
        this.$root.$on("reset", () => {
            this.vider();
            this.$root.$emit("nouveau-vehicule");
        });
        this.$root.$on("probleme", err => {
            this.errors = err;
            this.erreurs();
        });
        this.$root.$on("delete-errors", () => {
            this.vider_errors();
        });
    },
    updated() {
        store.state.infos = this.infos;
    },
    destroyed() {
        store.state.infos = {};
    },
    methods: {
        erreurs() {
            if (this.errors.dmc) {
                this.messages.dmc.exist = true;
                this.messages.dmc.value = this.errors.dmc[0];
            }
            if (this.errors.nom_deposant) {
                this.messages.nom_deposant.exist = true;
                this.messages.nom_deposant.value = this.errors.nom_deposant[0];
            }
            if (this.errors.immatriculation) {
                this.messages.immatriculation.exist = true;
                this.messages.immatriculation.value = this.errors.immatriculation[0];
            }
            if (this.errors.modele) {
                this.messages.modele.exist = true;
                this.messages.modele.value = this.errors.modele[0];
            }
            if (this.errors.chassis) {
                this.messages.chassis.exist = true;
                this.messages.chassis.value = this.errors.chassis[0];
            }
            if (this.errors.couleur) {
                this.messages.couleur.exist = true;
                this.messages.couleur.value = this.errors.couleur[0];
            }
            if (this.errors.type_vehicule) {
                this.messages.type_vehicule.exist = true;
                this.messages.type_vehicule.value = this.errors.type_vehicule[0];
            }
            if (this.errors.marque) {
                this.messages.marque.exist = true;
                this.messages.marque.value = this.errors.marque[0];
            }
            if (this.errors.annee) {
                this.messages.annee.exist = true;
                this.messages.annee.value = this.errors.annee[0];
            }
            if (this.errors.kilometrage_actuel) {
                this.messages.kilometrage_actuel.exist = true;
                this.messages.kilometrage_actuel.value = this.errors.kilometrage_actuel[0];
            }
            if (this.errors.prochaine_vidange) {
                this.messages.prochaine_vidange.exist = true;
                this.messages.prochaine_vidange.value = this.errors.prochaine_vidange[0];
            }
            if (this.errors.date_sitca) {
                this.messages.date_sitca.exist = true;
                this.messages.date_sitca.value = this.errors.date_sitca[0];
            }
            if (this.errors.date_assurance) {
                this.messages.date_assurance.exist = true;
                this.messages.date_assurance.value = this.errors.date_assurance[0];
            }
            if (this.errors.niveau_carburant) {
                this.messages.niveau_carburant.exist = true;
                this.messages.niveau_carburant.value = this.errors.niveau_carburant[0];
            }
        },
        vider() {
            this.infos.modele = null;
            this.infos.marque = null;
            this.infos.annee = null;
            this.infos.couleur = null;
            this.infos.chassis = null;
            this.infos.type_vehicule = null;
            this.infos.kilometrage_actuel = null;
            this.infos.prochaine_vidange = null;
            this.infos.date_assurance = null;
            this.infos.date_sitca = null;
            this.infos.niveau_carburant = null;
            this.infos.enjoliveur = [];
            this.infos.nom_deposant = null;
            this.infos.dmc = null;
        },
        vider_errors() {
            this.messages = {
                nom_deposant: {
                    exist: false,
                    value: null
                },
                dmc: {
                    exist: false,
                    value: null
                },
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
                },
                kilometrage_actuel: {
                    exist: false,
                    value: null
                },
                prochaine_vidange: {
                    exist: false,
                    value: null
                },
                date_sitca: {
                    exist: false,
                    value: null
                },
                date_assurance: {
                    exist: false,
                    value: null
                },
                niveau_carburant: {
                    exist: false,
                    value: null
                },
                prochaine_vidange: {
                    exist: false,
                    value: null
                }
            };
        }
    }
};
</script>

<style scoped></style>
