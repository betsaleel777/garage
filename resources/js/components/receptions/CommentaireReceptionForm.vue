<template>
    <div class="col-md-12">
        <div class="form-group">
            <h5 class="text-primary">Ressenti du client</h5>
            <hr />
            <textarea
                v-model="ressenti"
                class="form-control"
                cols="30"
                rows="6"
            ></textarea>
        </div>
        <div class="form-group">
            <h5 class="text-primary">Commentaires du réceptionniste</h5>
            <hr />
            <textarea
                class="form-control"
                v-model="commentaire.contenu"
                cols="30"
                rows="6"
            ></textarea>
        </div>
        <div v-if="commentaire.contenu.length > 0" class="form-group">
            <label for="upload">Fichier piece jointe</label>
            <vue-dropzone
                @vdropzone-success="saving"
                ref="myVueDropzone"
                id="dropzone"
                :options="dropzoneOptions"
            ></vue-dropzone>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
const token = document.head.querySelector('meta[name="csrf-token"]').content;
export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            ressenti: null,
            dropzoneOptions: {
                url: "/systeme/async/commentaire/reception/image/add",
                addRemoveLinks: true,
                thumbnailWidth: 150,
                maxFilesize: 4,
                dictDefaultMessage: "Cliquez ici pour choisir un fichier",
                dictFileTooBig: "Le fichier est trop grand",
                headers: { "X-CSRF-TOKEN": token }
            },
            commentaire: {
                images: [],
                contenu: ""
            }
        };
    },
    methods: {
        saving(file, response) {
            this.commentaire.images.push(response.chemin);
        }
    }
};
</script>

<style></style>
