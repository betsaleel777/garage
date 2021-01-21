<template>
    <div v-if="ouvert" class="intervention">
        <div>
            <label for="atelier">Pieces</label>
            <vue-select v-model="piece" :options="optionsPiece"></vue-select>

            <label for="quantite">Quantité</label>
            <input
                class="form-control"
                id="quantite"
                type="number"
                v-model="quantite"
            />
            <div class="bouton row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <button class="btn btn-primary ui-button">
                        <i class="fas fa-lg fa-plus-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label for="atelier">Atelier</label>
                <vue-select
                    v-model="atelier"
                    :options="optionsAtelier"
                ></vue-select>
                <span class="text-danger" v-if="messages.atelier.exist"
                    >{{ messages.atelier.value }}
                </span>
            </div>
            <div class="col-md-4">
                <label for="delais">Délais</label>
                <input
                    id="delais"
                    class="form-control"
                    placeholder="temps en heure"
                    type="number"
                    v-model="delais"
                />
            </div>
        </div>
        <div class="form-group">
            <label for="intervention">Commentaires</label>
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
            <div class="col-md-6"></div>
            <modal-fermeture :reception="reception"></modal-fermeture>
            <div class="col-md-3">
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
import VueSelect from "vue-select";
export default {
    components: {
        BFormSelect,
        ModalFermeture,
        VueSelect
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
        pieces: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            optionsAtelier: [],
            optionsPiece: [],
            delais: null,
            atelier: null,
            piece: null,
            quantite: null,
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
        this.optionsAtelier = this.ateliers.map(atelier => {
            return { code: atelier.id, label: atelier.nom };
        });
        this.optionsPiece = this.pieces.map(piece => {
            return { code: piece.id, label: piece.nom };
        });
        this.$root.$on("fermeture", () => {
            this.ouvert = false;
        });
    },
    methods: {
        enregistrer() {
            axios
                .post("/systeme/async/intervention/store", {
                    commentaire: this.intervention,
                    atelier: this.atelier,
                    reception: this.reception
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
            this.atelier = null;
            this.piece = null;
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
.bouton {
    margin-top: 5px;
}
</style>
