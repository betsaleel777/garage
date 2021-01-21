<template>
    <div class="col-md-3">
        <button @click="run" type="button" class="btn btn-danger ui-button">
            Fermer
        </button>
        <b-modal
            @cancel="cancel"
            @ok="fermer"
            id="end"
            title="FERMER LE DIAGNOSTIQUE"
        >
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temps">Délais estimé des travaux</label>
                        <input
                            class="form-control"
                            v-model="delais"
                            type="number"
                        />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unite">Délais estimé en </label>
                        <b-form-select
                            class="form-control"
                            v-model="unite"
                            :options="unites"
                        ></b-form-select>
                    </div>
                </div>
            </div>
            <span class="text-danger" v-if="messages.temps.exist"
                >{{ messages.temps.value }}
            </span>
            <div class="form-group">
                <label for="panne">Résumé des pannes</label>
                <textarea
                    v-model="panne"
                    class="form-control"
                    id="panne"
                    cols="30"
                    rows="5"
                ></textarea>
                <span class="text-danger" v-if="messages.panne.exist"
                    >{{ messages.panne.value }}
                </span>
            </div>
        </b-modal>
    </div>
</template>

<script>
import BVModal from "bootstrap-vue";
import { BFormSelect } from "bootstrap-vue";
export default {
    components: {
        BVModal,
        BFormSelect
    },
    props: {
        reception: Number
    },
    data() {
        return {
            panne: null,
            unite: "",
            delais: "",
            unites: [
                { text: "Jours", value: "jours" },
                { text: "Semaines", value: "semaines" },
                { text: "Mois", value: "mois" },
                { text: "Années", value: "années" }
            ],
            messages: {
                panne: {
                    exist: false,
                    value: null
                },
                temps: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    methods: {
        run() {
            this.$bvModal.show("end");
        },
        fermer(event) {
            event.preventDefault();
            axios
                .post("/maintenance/diagnostique/fermer", {
                    reception: this.reception,
                    panne: this.panne,
                    temps_estime: this.delais + this.unite
                })
                .then(result => {
                    let { message, diagnostique } = result.data;
                    this.$bvModal.hide("end");
                    this.vider();
                    this.$bvToast.toast(message, {
                        title: "OPERATION REUSSIE",
                        solid: true,
                        variant: "success"
                    });
                    this.$root.$emit("fermeture", diagnostique);
                })
                .catch(err => {
                    const errors = err.response.data.errors;
                    if (errors.panne) {
                        this.messages.panne.exist = true;
                        this.messages.panne.value = errors.panne[0];
                    }
                    if (errors.temps_estime) {
                        this.messages.temps.exist = true;
                        this.messages.temps.value = errors.temps_estime[0];
                    }
                });
        },
        cancel() {
            this.messages = {
                panne: {
                    exist: false,
                    value: null
                },
                temps: {
                    exist: false,
                    value: null
                }
            };
        },
        vider() {
            this.panne = null;
            this.unite = "";
            this.delais = "";
        }
    }
};
</script>

<style></style>
