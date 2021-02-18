<template>
	<div class="col-md-12">
		<div class="form-group">
			<h5 class="text-primary">Ressenti du client</h5>
			<hr />
			<textarea v-model="commentaire.ressenti" class="form-control" cols="30" rows="6"></textarea>
		</div>
		<div class="form-group">
			<h5 class="text-primary">Commentaires du réceptionniste</h5>
			<hr />
			<textarea class="form-control" v-model="commentaire.contenu" cols="30" rows="6"></textarea>
		</div>
		<div v-if="commentaire.contenu.length > 0" class="form-group">
			<label for="upload">Fichier piece jointe</label>
			<vue-dropzone
				@vdropzone-success="saving"
				ref="myVueDropzone"
				id="dropzone"
				:options="dropzoneOptions"
			></vue-dropzone>
			<small>
				<span v-if="messages.media.exist" class="text-danger">{{ messages.media.value }} </span>
			</small>
		</div>
	</div>
</template>

<script>
import store from "./Store"
import vue2Dropzone from "vue2-dropzone"
import "vue2-dropzone/dist/vue2Dropzone.min.css"

const token = document.head.querySelector('meta[name="csrf-token"]').content
export default {
	components: {
		vueDropzone: vue2Dropzone,
	},
	mounted() {
		this.$root.$on("reset", () => {
			this.vider()
		})
		this.$root.$on("probleme", err => {
			this.errors = err
		})
		this.$root.$on("delete-errors", () => {
			this.vider_errors()
		})
	},
	updated() {
		store.state.commentaire = this.commentaire
	},
	data() {
		return {
			dropzoneOptions: {
				url: "/systeme/async/commentaire/reception/image/add",
				addRemoveLinks: true,
				thumbnailWidth: 150,
				maxFilesize: 4,
				dictRemoveFile: "<i class='fa fa-remove'></i>",
				createImageThumbnails: false,
				acceptedFiles: [
					//images
					"image/png",
					"image/jpeg",
					"image/gif",
					//document
					"application/vnd.oasis.opendocument.text",
					"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
					"application/msword",
					"application/pdf",
					"text/plain",
					//videos
					"video/x-msvideo",
					"application/ogg",
					"video/mp4",
					"video/3gpp",
					//archives
					"application/zip",
					"application/x-7z-compressed",
					"application/vnd.rar",
				],
				dictMaxFilesExceeded: "limite de fichier atteinte!!",
				dictDefaultMessage: "Cliquez ici pour choisir un fichier",
				dictFileTooBig: "Le fichier est trop grand",
				headers: { "X-CSRF-TOKEN": token },
			},
			commentaire: {
				ressenti: "",
				images: [],
				contenu: "",
			},
			messages: {
				media: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		saving(file, response) {
			this.commentaire.images.push(response.chemin)
		},
		erreurs() {
			if (this.errors.media) {
				this.messages.media.exist = true
				this.messages.media.value = this.errors.media[0]
			}
		},
		vider_errors() {
			console.log("vidange")
			this.messages = {
				media: {
					exist: false,
					value: null,
				},
			}
		},
		vider() {
			this.commentaire = {
				ressenti: "",
				images: [],
				contenu: "",
			}
		},
	},
}
</script>

<style></style>
