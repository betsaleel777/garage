<template>
	<div class="container">
		<div class="row hauteur">
			<div class="col-md-6">
				<div class="form-group">
					<label for="nom">Libellé</label>
					<input id="nom" class="form-control form-control-sm" type="text" v-model="nom" />
				</div>
				<div class="form-group">
					<label for="urgence">Urgence de la demande</label>
					<vue-slider
						@change="changeRange"
						:processStyle="processStyle"
						:tooltipStyle="tooltipStyle"
						v-model="urgence"
						:data="sliderValues"
						:marks="true"
						:hide-label="true"
					></vue-slider>
					<small
						><span v-if="messages.urgence.exist" class="text-danger">{{
							messages.urgence.value
						}}</span></small
					>
				</div>
			</div>
			<div class="col-md-6">
				<label>Destinataire</label>
				<div class="form-group">
					<div class="form-check form-check-inline">
						<input
							class="form-check-input"
							type="radio"
							name="destinataire"
							v-model="destinataire"
							id="fournisseur"
							value="fournisseur"
						/>
						<label class="form-check-label" for="fournisseur">Fournisseur</label>
					</div>
					<div class="form-check form-check-inline">
						<input
							v-model="destinataire"
							class="form-check-input"
							type="radio"
							name="destinataire"
							id="magasin"
							value="magasin"
						/>
						<label class="form-check-label" for="magasin">Magasin</label>
					</div>
					<small
						><span v-if="messages.destinataire.exist" class="text-danger">{{
							messages.destinataire.value
						}}</span></small
					>
				</div>
				<label>Motif de la demande</label>
				<div class="form-group">
					<div class="form-check form-check-inline">
						<input
							class="form-check-input"
							type="radio"
							name="motif"
							v-model="motif"
							id="reparation"
							value="reparation"
						/>
						<label class="form-check-label" for="reparation">Pour réparation</label>
					</div>
					<div class="form-check form-check-inline">
						<input
							v-model="motif"
							class="form-check-input"
							type="radio"
							name="motif"
							id="approvisionnement"
							value="approvisionnement"
						/>
						<label class="form-check-label" for="approvisionnement">Pour approvisionnement</label>
					</div>
					<small
						><span v-if="messages.motif.exist" class="text-danger">{{ messages.motif.value }}</span></small
					>
				</div>
			</div>
			<div class="col-md-6">
				<div v-show="showMagasinField" class="form-group">
					<label for="magasin">Magasins</label>
					<vue-select placeholder="selectionez le magasin" :options="magasins" v-model="magasin"></vue-select>
					<small
						><span v-if="messages.magasin.exist" class="text-danger">{{
							messages.magasin.value
						}}</span></small
					>
				</div>
			</div>
			<div class="col-md-6">
				<div v-show="showReparationField" class="form-group">
					<label for="reparation">Réparations</label>
					<vue-select
						placeholder="selectionez le code de réparation"
						:options="reparations"
						v-model="reparation"
					></vue-select>
					<small
						><span v-if="messages.reparation.exist" class="text-danger">{{
							messages.reparation.value
						}}</span></small
					>
				</div>
			</div>
			<pieces-form />
		</div>
		<button @click="enregistrer" class="btn btn-primary btn-sm">enregistrer</button>
	</div>
</template>

<script>
import store from "./store"
import VueSlider from "vue-slider-component"
import VueSelect from "vue-select"
import PiecesForm from "./PiecesForm"

import "vue-slider-component/theme/default.css"
export default {
	components: {
		VueSlider,
		VueSelect,
		PiecesForm,
	},
	props: {
		pieces: {
			type: [Object, Array],
			required: true,
		},
		magasins: {
			type: [Object, Array],
			required: true,
		},
		reparations: {
			type: [Object, Array],
			required: true,
		},
	},
	watch: {
		motif(value) {
			if (value === "reparation") {
				this.showReparationField = true
			} else {
				this.showReparationField = false
			}
		},
		destinataire(value) {
			if (value === "magasin") {
				this.showMagasinField = true
			} else {
				this.showMagasinField = false
			}
		},
	},
	created() {
		store.state.pieces = this.pieces
	},
	data() {
		return {
			nom: "",
			motif: "",
			destinataire: "",
			showReparationField: false,
			showMagasinField: false,
			reparation: null,
			magasin: null,
			urgence: "normale",
			sliderValues: ["faible", "normale", "elévée", "maxiamle"],
			processStyle: { "background-color": "blue" },
			tooltipStyle: { "background-color": "blue" },
			messages: {
				urgence: {
					exist: false,
					value: null,
				},
				motif: {
					exist: false,
					value: null,
				},
				destinataire: {
					exist: false,
					value: null,
				},
				magasin: {
					exist: false,
					value: null,
				},
				reparation: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		changeRange() {
			if (this.urgence === "faible") {
				this.processStyle = { "background-color": "green" }
				this.tooltipStyle = { "background-color": "green" }
			} else if (this.urgence === "normale") {
				this.processStyle = { "background-color": "blue" }
				this.tooltipStyle = { "background-color": "blue" }
			} else if (this.urgence === "elévée") {
				this.processStyle = { "background-color": "orange" }
				this.tooltipStyle = { "background-color": "orange" }
			} else {
				this.processStyle = { "background-color": "red" }
				this.tooltipStyle = { "background-color": "red" }
			}
		},
		checkPieces() {
			let found = false
			let pieceCheck = false
			let message = ""
			const pieces = store.state.rowPieces.length > 0 ? store.state.rowPieces : []
			if (pieces.length === 0) {
				message = "La commande n'est pas valide car aucune pièce n'a été sélectionnée.\n"
				pieceCheck = true
			}
			for (let index = 0; index < pieces.length; index++) {
				const piece = pieces[index]
				if (piece.quantite === 0) {
					found = true
					message = "Veuillez renseigner des quantités de pieces valide, aucune quantité vide n'est acceptée."
				}
			}
			if (message.length > 0) this.notifier(message, "OPERATION BLOQUEE", "warning")
			return !found && !pieceCheck
		},
		clearMessages() {
			this.messages = {
				urgence: {
					exist: false,
					value: null,
				},
				motif: {
					exist: false,
					value: null,
				},
				destinataire: {
					exist: false,
					value: null,
				},
				magasin: {
					exist: false,
					value: null,
				},
				reparation: {
					exist: false,
					value: null,
				},
			}
		},
		enregistrer() {
			this.clearMessages()
			if (this.checkPieces()) {
				const postObject = {
					nom: this.nom,
					urgence: this.urgence,
					destinataire: this.destinataire,
					motif: this.motif,
					reparation: this.reparation ? this.reparation.code : null,
					magasin: this.magasin ? this.magasin.code : null,
					pieces: store.state.rowPieces,
				}
				this.axios
					.post("/stock/demande/store", { ...postObject })
					.then(result => {
						this.dialogNewDemande()
					})
					.catch(err => {
						const { errors } = err.response.data
						if (errors) {
							this.errorWriting(errors)
						}
					})
			}
		},
		dialogNewDemande() {
			this.$bvModal
				.msgBoxConfirm("Voulez vous créer à nouveau une demande ?", {
					title: "Confirmer nouvelle Demande",
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
						location.href = "/stock/demande"
					}
				})
				.catch(err => {})
		},
		errorWriting(err) {
			if (err.motif) {
				this.messages.motif.exist = true
				this.messages.motif.value = err.motif[0]
			}
			if (err.urgence) {
				this.messages.urgence.exist = true
				this.messages.urgence.value = err.urgence[0]
			}
			if (err.magasin) {
				this.messages.magasin.exist = true
				this.messages.magasin.value = err.magasin[0]
			}
			if (err.reparation) {
				this.messages.reparation.exist = true
				this.messages.reparation.value = err.reparation[0]
			}
			if (err.destinataire) {
				this.messages.destinataire.exist = true
				this.messages.destinataire.value = err.destinataire[0]
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

<style>
.hauteur {
	margin-bottom: 3%;
}
</style>
