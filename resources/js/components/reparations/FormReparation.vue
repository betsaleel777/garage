<template>
    <div v-if="ouvert" class="intervention">
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label for="atelier">Atelier</label>
                    <b-form-select
                        v-model="selected"
                        :options="options"
                    ></b-form-select>
                    <span class="text-danger" v-if="messages.atelier.exist"
                        >{{ messages.atelier.value }}
                    </span>
                </div>
                <div class="col-md-4">
                    <label for="atelier">Pieces</label>
                    <b-form-select disabled></b-form-select>
                </div>
                <div class="col-md-4">
                    <label for="atelier">Quantité</label>
                    <b-form-select disabled></b-form-select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="intervention">Commentaires d'intervention</label>
            <textarea
                v-model="intervention"
                class="form-control"
                id="intervention"
                cols="30"
                rows="6"
            ></textarea>
            <span class="text-danger" v-if="messages.commentaire.exist"
                >{{ messages.commentaire.value }}
            </span>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <modal-fermeture :reception="reception"></modal-fermeture>
            <div class="col-md-2">
                <button
                    @click="enregistrer"
                    type="button"
                    class="btn btn-primary ui-button"
                >
                    Enregistrer
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { BFormSelect } from "bootstrap-vue";
import ModalFermeture from "./ModalFermeture";
export default {
    components: {
        BFormSelect,
        ModalFermeture
    },
    props: {
        reception: {
            type: Number,
            required: true
        },
        ateliers: {
            type: Array,
            required: true
        },
        reparation: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            options: [],
            selected: null,
            intervention: null,
            ouvert: true,
            messages: {
                commentaire: {
                    exist: false,
                    value: null
                },
                atelier: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    mounted() {
        this.options = this.ateliers.map(atelier => {
            return { value: atelier.id, text: atelier.nom };
        });
        this.$root.$on("fermeture", () => {
            this.ouvert = false;
        });
        this.$root.$on("finished", () => {
            this.ouvert = false;
        });
    },
    methods: {
        enregistrer() {
            axios
                .post("/systeme/async/intervention/reparation/store", {
                    commentaire: this.intervention,
                    atelier: this.selected,
                    reception: this.reception,
                    reparation: this.reparation
                })
                .then(result => {
                    let { message, intervention } = result.data;
                    this.vider();
                    this.$bvToast.toast(message, {
                        title: "OPERATION REUSSIE",
                        solid: true,
                        variant: "success"
                    });
                    this.$root.$emit("new-comment", intervention);
                })
                .catch(err => {
                    const errors = err.response.data.errors;
                    if (errors.commentaire) {
                        this.messages.commentaire.exist = true;
                        this.messages.commentaire.value = errors.commentaire[0];
                    }
                    if (errors.atelier) {
                        this.messages.atelier.exist = true;
                        this.messages.atelier.value = errors.atelier[0];
                    }
                });
        },
        vider() {
            this.selected = null;
            this.intervention = null;
            this.messages = {
                commentaire: {
                    exist: false,
                    value: null
                },
                atelier: {
                    exist: false,
                    value: null
                }
            };
        }
    }
};
</script>

<style scoped>
.intervention {
    margin-bottom: 3%;
}
</style>
