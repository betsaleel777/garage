<template>
    <div>
        <a class="text-primary" @click="runModal"
            ><i class="fas fa-lg fa-edit"></i
        ></a>
        <div hidden ref="myslot"><slot></slot></div>
        <b-modal
            @ok="enregistrer"
            size="lg"
            :id="`edit-${reception}`"
            :title="`Essais de la réception ${code}`"
        >
            <div class="form-group">
                <label>Ressenti Client</label>
                <p>
                    <small>{{ ressenti }}</small>
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
        reception: Number,
        code: String,
        ressenti: String,
        comment: String
    },
    data() {
        return {
            commentaire: "",
            messages: {
                ressenti: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    mounted() {
        this.commentaire = this.$refs.myslot.textContent.trim();
    },
    methods: {
        runModal() {
            this.$bvModal.show("edit-" + this.reception);
        },
        enregistrer(event) {
            event.preventDefault();
            axios
                .post("/maintenance/essai/pre/update", {
                    reception: this.reception,
                    commentaire: this.commentaire
                })
                .then(result => {
                    location.reload();
                })
                .catch(err => {
                    this.messages.ressenti.exist = true;
                    this.messages.ressenti.value =
                        err.response.data.errors.commentaire[0];
                });
        }
    }
};
</script>

<style></style>
