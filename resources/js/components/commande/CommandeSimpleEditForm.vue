<template>
	<div class="container">
		<form action="" enctype="multipart/form-data">
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label for="magasin">Magasin</label>
						<vue-select v-model="magasin" id="magasin" :options="magasins"></vue-select>
						<span v-if="messages.magasin.exist" class="text-danger">
							<small>{{ messages.magasin.value }}</small>
						</span>
					</div>
					<div class="col-md-6">
						<label for="fournisseur">fournisseur</label>
						<vue-select v-model="fournisseur" id="fournisseur" :options="fournisseurs"></vue-select>
						<span v-if="messages.fournisseur.exist" class="text-danger">
							<small>{{ messages.fournisseur.value }}</small>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<products-edit-form :key="cle" :piecesSelected="selectedPieces" :pieces="pieces" />
			</div>
			<div>
				<ul>
					<li v-for="media in commande.medias" :key="media.id">
						<a :href="`/storage/${media.media}`">{{ media.media.split("/")[1] }}</a>
						<span class="text-danger overable">
							<i class="fas fa-trash-alt fa-sm"></i>
						</span>
					</li>
				</ul>
			</div>
			<div class="form-group">
				<label for="doc">Documents joints</label>
				<b-form-file
					accept="application/vnd.oasis.opendocument.text,
					        application/vnd.openxmlformats-officedocument.wordprocessingml.document,
					        application/msword,
					        application/pdf,
					        text/plain"
					v-model="documents"
					placeholder="aucun fichier selectioné"
					id="doc"
					multiple
					size="sm"
				>
					<template slot="file-name" slot-scope="{ names }">
						<b-badge variant="primary">{{ names[0] }}</b-badge>
						<b-badge v-if="names.length > 1" variant="primary" class="ml-1">
							+ {{ names.length - 1 }} fichier en plus
						</b-badge>
					</template>
				</b-form-file>
			</div>
			<div class="form-group">
				<label for="notes">Notes</label>
				<textarea
					placeholder="remarques ou appréciations au sujet de cette commande"
					class="form-control form-control-sm"
					id="notes"
					cols="30"
					rows="4"
					v-model="notes"
				></textarea>
			</div>
			<div class="text-align-right">
				<button @click="enregistrer" type="button" class="btn btn-primary btn-sm">enregistrer</button>
			</div>
		</form>
	</div>
</template>

<script>
import store from "./store"
import ProductsEditForm from "./ProductsEditForm"
import VueSelect from "vue-select"
import { BFormFile, BBadge } from "bootstrap-vue"
export default {
	components: {
		ProductsEditForm,
		VueSelect,
		BFormFile,
		BBadge,
	},
	props: {
		pieces: {
			type: [Object, Array],
			required: true,
		},
		fournisseurs: {
			type: [Object, Array],
			required: true,
		},
		magasins: {
			type: [Object, Array],
			required: true,
		},
		from: {
			type: String,
			required: true,
		},
		commande: {
			type: [Object, Array],
			required: true,
		},
	},
	mounted() {
		this.selectedPieces = this.commande.pieces.map(piece => {
			return {
				code: piece.id,
				reference: piece.reference,
				name: piece.nom,
				achat: piece.pivot.prix_achat,
				vente: piece.pivot.prix_vente,
				quantite: piece.pivot.quantite,
			}
		})
		this.cle = !this.cle
		this.notes = this.commande.notes
		this.magasin = this.magasins.filter(magasin => magasin.code === this.commande.magasin)
		this.fournisseur = this.fournisseurs.filter(fournisseur => fournisseur.code === this.commande.fournisseur)
	},
	data() {
		return {
			magasin: "",
			documents: [],
			notes: "",
			cle: false,
			selectedPieces: [],
			fournisseur: "",
			messages: {
				fournisseur: {
					exist: false,
					value: null,
				},
				magasin: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		enregistrer() {
			//prevent pour faire nextick si tout va bien
			if (!store.state.pieces.length > 0) {
				this.notifier(
					"La commande n'est pas valide car aucune piece n'a été selectionée",
					"OPERATION ECHOUEE",
					"danger"
				)
			} else {
				this.save()
			}
		},
		save() {
			this.clearMessages()
			let formdata = new FormData()
			formdata.append("magasin", this.magasin ? this.magasin.code : "")
			formdata.append("fournisseur", this.fournisseur ? this.fournisseur.code : "")
			formdata.append("notes", this.notes)
			formdata.append("commande", this.commande.id)
			this.documents.forEach(file => {
				formdata.append("medias[]", file)
			})
			store.state.pieces.forEach(piece => {
				formdata.append("pieces[]", JSON.stringify(piece))
			})
			this.axios
				.post(`/${this.from}/commande/simple/update`, formdata, {
					headers: {
						"content-type": "multipart/form-data",
					},
				})
				.then(result => {
					this.dialogNewCommande()
				})
				.catch(err => {
					const { errors } = err.response.data
					if (errors) {
						this.errorWriting(errors)
					}
				})
		},
		dialogNewCommande() {
			this.$bvModal
				.msgBoxConfirm("Voulez vous créer à nouveau une commande ?", {
					title: "Confirmer nouvelle commande",
					size: "md",
					buttonSize: "sm",
					okVariant: "primary",
					okTitle: "Confirmer",
					cancelTitle: "Abandonner",
					footerClass: "p-2",
					hideHeaderClose: false,
					centered: true,
				})
				.then(value => {
					if (value) {
						location.reload()
					} else {
						location.href = `/${this.from}/commande/simple/liste`
					}
				})
				.catch(err => {})
		},
		clearMessages() {
			this.messages = {
				fournisseur: {
					exist: false,
					value: null,
				},
				magasin: {
					exist: false,
					value: null,
				},
			}
		},
		errorWriting(errors) {
			if (errors.fournisseur) {
				this.messages.fournisseur.exist = true
				this.messages.fournisseur.value = errors.fournisseur[0]
			}
			if (errors.magasin) {
				this.messages.magasin.exist = true
				this.messages.magasin.value = errors.magasin[0]
			}
		},
		notifier(message, titre, variant) {
			this.$bvToast.toast(message, {
				title: titre,
				solid: true,
				variant: variant,
			})
		},
	},
}
</script>

<style scoped>
.overable::hover {
	background-color: brown;
}
</style>
