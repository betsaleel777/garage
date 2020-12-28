<template>
    <div>
        <a class="text-primary" @click="runModal"
            ><i class="fas fa-lg fa-edit"></i
        ></a>
        <b-modal
            scrollable
            button-size="sm"
            size="lg"
            @ok="enregistrer"
            :id="`add-${reception}`"
            :title="`Essais de la réception ${code}`"
        >
            <div class="form-group">
                <label>Ressenti du client</label>
                <p>
                    <small>{{ ressenti }}</small>
                </p>
            </div>
            <div
                v-for="reparation in rapports_reparation"
                :key="reparation.id"
                class="form-group"
            >
                <label>Rapport de réparation N°{{ reparation.rang }}</label>
                <p>
                    <small>{{ reparation.texte }}</small>
                </p>
            </div>
            <div class="form-group">
                <label for="ressenti">Ressenti Essayeur</label>
                <textarea
                    class="form-control"
                    v-model="commentaire"
                    id="ressenti"
                    cols="30"
                    rows="6"
                ></textarea>
                <span v-if="messages.ressenti.exist" class="text-danger">{{
                    messages.ressenti.value
                }}</span>
            </div>
            <template #modal-footer="{cancel}">
                <button @click="accepter(false)" class="btn btn-danger">
                    reparation incorrecte
                </button>
                <button @click="accepter(true)" class="btn btn-success">
                    reparation correcte
                </button>
                <button @click="cancel()" class="btn btn-secondary">
                    cancel
                </button>
            </template>
        </b-modal>
    </div>
</template>

<script>
import BVModal from "bootstrap-vue";
export default {
    components: {
        BVModal
    },
    props: {
        bigreception: Object
    },
    data() {
        return {
            commentaire: "",
            reception: null,
            code: null,
            ressenti: null,
            reponse: null,
            rapports_reparation: [],
            messages: {
                ressenti: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    mounted() {
        this.reception = this.bigreception.id;
        this.code = this.bigreception.code;
        this.ressenti = this.bigreception.ressenti;
        this.commentaire = this.bigreception.postessai.commentaire;
        var rang = 0;
        this.rapports_reparation = this.bigreception.reparation.finished.map(
            rapport => {
                return {
                    rang: (rang = rang + 1),
                    id: rapport.id,
                    texte: rapport.texte
                };
            }
        );
    },
    methods: {
        runModal() {
            this.$bvModal.show("add-" + this.reception);
        },
        enregistrer(event) {
            event.preventDefault();
            axios
                .post("/maintenance/essai/post/update", {
                    reception: this.reception,
                    commentaire: this.commentaire,
                    accepter: this.reponse
                })
                .then(result => {
                    location.reload();
                })
                .catch(err => {
                    this.messages.ressenti.exist = true;
                    this.messages.ressenti.value =
                        err.response.data.errors.commentaire[0];
                });
        },
        accepter(value) {
            this.reponse = value;
            this.enregistrer(event);
        }
    }
};
</script>

<style></style>
