<template>
	<div>
		<a class="text-primary" @click="runModal"><i class="fas fa-lg fa-plus-circle"></i></a>
		<b-modal
			@ok="enregistrer"
			size="lg"
			:id="`add-${bigreception.id}`"
			:title="`Essais de la réception ${bigreception.code}`"
		>
			<div class="form-group">
				<label>Ressenti Client</label>
				<p>
					<small>{{ bigreception.ressenti }}</small>
				</p>
				<label>Commentaire du réceptioniste</label>
				<p>
					<small>{{ bigreception.commentaire.contenu }}</small>
				</p>
				<label>Fichier en piece jointe</label>
				<p v-if="sourcesLightbox.length > 0">
					<button @click="toggler = !toggler" class="btn btn-outline-primary btn-sm">
						Visualiser les pieces jointes
					</button>
					<fs-lightbox
						:toggler="toggler"
						:sources="sourcesLightbox"
						initialAnimation="scale-in-long"
						slideChangeAnimation="scale-in"
						:onClose="lightboxClosed"
					/>
				</p>
				<!-- <p v-if="sourcesDownload.length>0">
                    <ul>
                        <li v-for="source in sourcesDownload" :key="source.caption">
                           <a :href="source.lien" download >{{source.caption}}</a>
                        </li>
                    </ul>
                </p> -->
			</div>
			<div class="form-group">
				<label for="ressenti">Ressenti Essayeur</label>
				<textarea class="form-control" v-model="commentaire" id="ressenti" cols="30" rows="6"></textarea>
				<span v-if="messages.ressenti.exist" class="text-danger">{{ messages.ressenti.value }}</span>
			</div>
			<template #modal-footer="{ok,cancel}">
				<button @click="showReception" class="btn btn-warning">
					détails véhicule
				</button>
				<button @click="cancel()" class="btn btn-secondary">
					cancel
				</button>
				<button @click="ok()" class="btn btn-primary">ok</button>
			</template>
		</b-modal>
		<modal-detail-reception :reception="bigreception" />
	</div>
</template>

<script>
import BVModal from "bootstrap-vue"
import FsLightbox from "fslightbox-vue"
import ModalDetailReception from "../ModalDetailReception"
export default {
	components: {
		BVModal,
		ModalDetailReception,
		FsLightbox,
	},
	props: {
		bigreception: Object,
	},
	mounted() {
		this.initialisation()
	},
	data() {
		return {
			commentaire: "",
			toggler: false,
			sourcesLightbox: [],
			sourcesDownload: [],
			messages: {
				ressenti: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		initialisation() {
			const documentExtensions = ["docx", "pdf", "txt", "odt", "doc", "zip", "7z", "rar"]
			this.bigreception.commentaire.medias.forEach(file => {
				const splited = file.media.split(".")
				const caption = splited[0]
				const extension = splited[1]
				if (!documentExtensions.includes(extension)) {
					this.sourcesLightbox.push("/storage/media_reception/" + file.media)
				} else {
					this.sourcesDownload.push({ lien: "storage/media_reception/" + file.media, caption })
				}
			})
		},
		runModal() {
			this.$bvModal.show("add-" + this.bigreception.id)
		},
		enregistrer(event) {
			event.preventDefault()
			axios
				.post("/maintenance/essai/pre/store", {
					reception: this.bigreception.id,
					commentaire: this.commentaire,
				})
				.then(result => {
					location.reload()
				})
				.catch(err => {
					this.messages.ressenti.exist = true
					this.messages.ressenti.value = err.response.data.errors.commentaire[0]
				})
			this.$nextTick(() => {
				this.$bvModal.hide("add-" + this.bigreception.id)
			})
		},
		lightboxClosed() {
			alert("cobra!!")
		},
		showReception() {
			this.$bvModal.show("detail-reception-" + this.bigreception.id)
		},
	},
}
</script>

<style></style>
