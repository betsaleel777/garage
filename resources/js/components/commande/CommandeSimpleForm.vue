<template>
	<div class="container">
		<form action="" enctype="multipart/form-data">
			<div class="form-group">
				<label for="reference">Réference</label>
				<input class="form-control form-control-sm" type="text" id="reference" v-model="reference" />
				<span v-if="messages.reference.exist" class="text-danger">
					<small>{{ messages.reference.value }}</small>
				</span>
			</div>
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
						<supplier-form :error="messages.fournisseur" :fournisseurs="suppliers" :key="cle" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<products-form :pieces="pieces" />
			</div>
			<div class="form-group">
				<label for="doc">Documents joints</label>
				<b-form-file v-model="documents" placeholder="aucun fichier selectioné" id="doc" multiple size="sm">
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
import ProductsForm from "./ProductsForm"
import SupplierForm from "./SupplierForm"
import VueSelect from "vue-select"
import { BFormFile, BBadge } from "bootstrap-vue"
export default {
	components: {
		ProductsForm,
		SupplierForm,
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
	},
	mounted() {
		this.suppliers = this.fournisseurs
		this.$root.$on("supplier-added", () => {
			this.refreshSupplier()
		})
	},
	data() {
		return {
			magasin: "",
			documents: [],
			reference: "",
			notes: "",
			suppliers: [],
			fournisseur: "",
			cle: false,
			messages: {
				fournisseur: {
					exist: false,
					value: null,
				},
				reference: {
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
		refreshSupplier() {
			axios
				.get("/systeme/fournisseur/all/select")
				.then(result => {
					this.suppliers = result.data.fournisseurs
				})
				.catch(err => {})
		},
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
			formdata.append("reference", this.reference)
			formdata.append("notes", this.notes)
			formdata.append("fournisseur", store.state.fournisseur ? store.state.fournisseur.code : "")
			this.documents.forEach(file => {
				formdata.append("medias[]", file)
			})
			store.state.pieces.forEach(piece => {
				formdata.append("pieces[]", JSON.stringify(piece))
			})
			this.axios
				.post(`/${this.from}/commande/simple/store`, formdata, {
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
				reference: {
					exist: false,
					value: null,
				},
				magasin: {
					exist: false,
					value: null,
				},
			}
			this.cle = !this.cle
		},
		errorWriting(errors) {
			if (errors.fournisseur) {
				this.messages.fournisseur.exist = true
				this.messages.fournisseur.value = errors.fournisseur[0]
				this.cle = !this.cle
			}
			if (errors.reference) {
				this.messages.reference.exist = true
				this.messages.reference.value = errors.reference[0]
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

<style></style>
