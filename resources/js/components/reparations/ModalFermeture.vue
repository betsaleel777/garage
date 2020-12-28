<template>
    <div class="col-md-2">
        <button @click="run" type="button" class="btn btn-danger ui-button">
            Fin des réparations
        </button>
        <b-modal
            @cancel="cancel"
            @ok="fermer"
            id="end"
            title="TERMINEE LA REPARATION"
        >
            <div class="form-group">
                <label for="panne">Résumé des réparations effectuées</label>
                <textarea
                    v-model="resume"
                    class="form-control"
                    id="resume"
                    cols="30"
                    rows="5"
                ></textarea>
                <span class="text-danger" v-if="messages.resume.exist"
                    >{{ messages.resume.value }}
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
            resume: null,
            messages: {
                resume: {
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
                .post("/maintenance/reparation/fermer", {
                    reception: this.reception,
                    texte: this.resume
                })
                .then(result => {
                    let { message, resume } = result.data;
                    this.$bvModal.hide("end");
                    this.vider();
                    this.$bvToast.toast(message, {
                        title: "OPERATION REUSSIE",
                        solid: true,
                        variant: "success"
                    });
                    this.$root.$emit("finished", resume);
                })
                .catch(err => {
                    const errors = err.response.data.errors;
                    if (errors.resume) {
                        this.messages.resume.exist = true;
                        this.messages.resume.value = errors.texte[0];
                    }
                });
        },
        cancel() {
            this.messages = {
                resume: {
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
            this.resume = null;
        }
    }
};
</script>

<style></style>
