<template>
	<div class="card">
		<div class="card-body">
			<h5 class="text-primary">Création des zones de stockage</h5>
			<hr />
			<div class="form-row">
				<div class="col-7">
					<input
						ref="nom"
						v-on:keyup.enter="ajouter"
						placeholder="Nom de la zone"
						type="text"
						v-model.trim="zone.nom"
						class="form-control form-control-sm"
					/>
				</div>
				<div class="col-1">
					<button v-if="currentStep" @click="generer" class="btn btn-primary btn-sm ui-button">
						<i class="fas fa-cog fa-sm"></i>
					</button>
				</div>
				<div class="col-3">
					<input
						v-on:keyup.enter="ajouter"
						placeholder="identifiant"
						type="text"
						v-model.trim="zone.identifiant"
						class="form-control form-control-sm"
					/>
				</div>
				<div class="col-1">
					<button v-if="currentStep" @click="ajouter" class="btn btn-primary btn-sm ui-button">
						<i class="fas fa-plus-circle fa-sm"></i>
					</button>
				</div>
			</div>
			<vue-custom-scrollbar class="scrollarea" :settings="options">
				<div style="margin-top: 3%" v-if="zones.length > 0" class="row">
					<div class="col-md-11">
						<ul class="listing">
							<li v-for="element in zones" :key="element.id">
								{{ element.nom }} (#{{ element.identifiant }})
								<span v-if="currentStep" style="margin-left:1%">
									<span class="text-primary overable"
										><i @click="runEdit(element.id)" class="fas fa-edit fa-sm"></i
									></span>
									<span class="text-danger overable"
										><i @click="deleteZone(element.id)" class="fas fa-trash-alt fa-sm"></i
									></span>
									<modal-edit-zone
										:zoneOld="{
											identifiant: element.identifiant,
											nom: element.nom,
											id: element.id,
										}"
										@zone-edit="modifier"
									/>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</vue-custom-scrollbar>
		</div>
		<div class="card-footer">
			<div v-if="currentStep" style="float:left">
				<button @click="precedent" class="btn btn-outline-primary btn-sm">
					précedent
				</button>
			</div>
			<div v-if="currentStep" style="float:right">
				<button @click="suivant" class="btn btn-outline-primary btn-sm">
					{{ textButton }}
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import store from "../store"
import vueCustomScrollbar from "vue-custom-scrollbar"
import ModalEditZone from "./ModalEditZone"
import "vue-custom-scrollbar/dist/vueScrollbar.css"

const duplicate = function(newZone, zones) {
	let found = false
	let message = ""
	if (zones.length > 0) {
		zones.forEach(zone => {
			if (zone.identifiant === newZone.identifiant || zone.nom === newZone.nom) {
				if (zone.identifiant === newZone.identifiant)
					message += `Identifiant "${zone.identifiant}" existe déjà.`
				if (zone.nom === newZone.nom) message += `Le nom de zone "${zone.nom}" existe déjà.`
				found = true
			}
		})
	}
	return { found, message }
}
export default {
	components: {
		vueCustomScrollbar,
		ModalEditZone,
	},
	computed: {
		textButton() {
			return this.zones.length === 0 ? "passer" : "valider"
		},
	},
	mounted() {
		this.$refs.nom.focus()
	},
	data() {
		return {
			currentStep: true,
			compteur: 1,
			zone: {
				nom: "",
				identifiant: "",
			},
			zones: [],
			options: {
				suppressScrollY: false,
				suppressScrollX: true,
				wheelPropagation: false,
			},
		}
	},
	methods: {
		suivant() {
			store.state.zones = JSON.parse(JSON.stringify(this.zones))
			this.$emit("second-to-third")
			this.currentStep = false
		},
		precedent() {
			store.state.zones = []
			this.$emit("second-to-first")
		},
		deleteZone(id) {
			this.zones = this.zones.filter(zone => zone.id !== id)
		},
		modifier(newZone) {
			//vérification de duplication
			const zones = this.zones.filter(zone => zone.id !== newZone.id)
			const { found, message } = duplicate(newZone, zones)
			if (!found) {
				this.zones.forEach(zone => {
					if (newZone.id === zone.id) {
						zone.nom = newZone.nom
						zone.identifiant = newZone.identifiant
					}
				})
			} else {
				this.notifier(message, "ATTENTION", "warning")
			}
		},
		runEdit(id) {
			this.$bvModal.show("modal-" + id)
		},
		vider() {
			this.zone = {
				nom: "",
				identifiant: "",
			}
		},
		ajouter() {
			const { nom, identifiant } = this.zone
			if (nom.length > 0 && identifiant.length > 0) {
				if (!this.foundOnServer() || !foundOnClient()) {
					const { found, message } = duplicate(this.zone, this.zones)
					if (!found) {
						this.zones.push({ nom, identifiant, status: "not done", id: this.compteur })
						this.compteur++
						this.vider()
					} else {
						this.notifier(message, "ATTENTION", "warning")
					}
					this.$refs.nom.focus()
				} else {
					this.vider()
					this.notifier("veuillez renseigner à nouveau la zone", "DUPLICATION DETECTEE", "warning")
				}
			}
		},
		generer() {
			axios
				.get("/systeme/async/magasin/generer/code-zone")
				.then(result => {
					const { found, code } = result.data
					if (!found) {
						this.zone.identifiant = code
					}
				})
				.catch(err => {
					console.log(err)
				})
		},
		foundOnServer() {
			axios
				.get("/systeme/async/magasin/find/code-zone/" + this.zone.identifiant)
				.then(result => {
					return result.data
				})
				.catch(err => {
					console.log(err)
				})
		},
		foundOnClient() {
			let found = false
			zonesFound = this.zones.filter(zone => zone.identifiant === this.zone.identifiant)
			zonesFound.length > 0 ? (found = true) : null
			return found
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
.scrollarea {
	height: 7.8em;
}
.listing {
	font-size: 1em;
}
.overable:hover {
	background-color: darkgray;
}
</style>
