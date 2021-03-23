<template>
	<div class="container">
		<form action="" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="reference">Réference</label>
						<input class="form-control form-control-sm" type="text" id="reference" v-model="reference" />
						<span v-if="messages.reference.exist" class="text-danger">
							<small>{{ messages.reference.value }}</small>
						</span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="magasin">Magasin qui réceptionne</label>
						<vue-select v-model="magasin" id="magasin" :options="magasins"></vue-select>
						<span v-if="messages.magasin.exist" class="text-danger">
							<small>{{ messages.magasin.value }}</small>
						</span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<div v-if="Boolean(demande.magasin)">
							<label for="magasin">A commander vers le magasin</label>
							<vue-select v-model="magasin" id="magasin" :options="magasins"></vue-select>
							<span v-if="messages.magasin.exist" class="text-danger">
								<small>{{ messages.magasin.value }}</small>
							</span>
						</div>
						<div v-else>
							<supplier-form :error="messages.fournisseur" :fournisseurs="suppliers" :key="cle" />
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<piece-table-plug />
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
import PieceTablePlug from "./PiecesTablePlug"
import SupplierForm from "./SupplierForm"
import VueSelect from "vue-select"
import { BFormFile, BBadge } from "bootstrap-vue"
const checkPiece = function(pieces) {
	let greaterQuantite = false
	for (const piece of pieces) {
		if (piece.quantite > piece.demande - piece.deja) {
			greaterQuantite = true
			break
		}
	}
	return { greaterQuantite }
}
export default {
	components: {
		PieceTablePlug,
		SupplierForm,
		VueSelect,
		BFormFile,
		BBadge,
	},
	props: {
		demande: {
			type: [Object, Array],
			required: true,
		},
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
	created() {
		store.state.demande = this.demande
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
			const { greaterQuantite } = checkPiece(store.state.pieces)
			if (greaterQuantite) {
				this.notifier(
					"La quantité soumise n'est pas exacte, veuillez renseigner une quantité inférieure à celle demandée.",
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
			formdata.append("demande", this.demande.id)
			formdata.append("reference", this.reference)
			formdata.append("notes", this.notes)
			formdata.append("commandToWarehouse", Boolean(this.demande.magasin) ? this.demande.magasin : "")
			formdata.append("magasin", this.magasin ? this.magasin.code : "")
			formdata.append("fournisseur", store.state.fournisseur ? store.state.fournisseur.code : "")
			this.documents.forEach(file => {
				formdata.append("medias[]", file)
			})
			store.state.pieces.forEach(piece => {
				formdata.append("pieces[]", JSON.stringify(piece))
			})
			this.axios
				.post(`/${this.from}/commande/simple/store/plug`, formdata, {
					headers: {
						"content-type": "multipart/form-data",
					},
				})
				.then(() => {
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
					value ? location.reload() : (location.href = `/${this.from}/commande/simple/liste`)
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
