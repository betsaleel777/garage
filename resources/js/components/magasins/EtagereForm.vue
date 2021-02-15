<template>
	<div class="card">
		<div class="card-body">
			<h5 class="text-primary">Création des étagères</h5>
			<hr />
			<div v-if="etageres.constructor.name === 'Object'" class="row">
				<!-- zone déjà remplie -->
				<div class="col-md-6" v-for="element in zonesDone" :key="element.id">
					<h6>
						<b>{{ "Zone: " + element.nom }}</b>
					</h6>
					<div v-if="element.status === 'done'">
						<!-- visualisation des données d'étagères -->
						<div style="margin-top: 3%" class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<th>Nom</th>
										<th>Identifiant</th>
									</thead>
									<tbody>
										<tr v-for="element in etageres[element.identifiant]" :key="element.id">
											<td>{{ element.nom }}</td>
											<td>{{ element.identifiant }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- zone en cours de remplissage -->
				<div v-if="Object.keys(zoneEncour).length > 0" class="col-md-6">
					<h6>
						<b>{{ "Pour la zone: " + zoneEncour.nom }}</b>
					</h6>
					<!-- formulaire d'enregistrement des étagères avec visualisation des données -->
					<!-- formulaire -->
					<div class="form-row">
						<div class="col-7">
							<input
								ref="nom"
								placeholder="Nom d'étagère"
								type="text"
								v-model.trim="etagere.nom"
								class="form-control form-control-sm"
							/>
						</div>
						<div class="col-1">
							<button @click="generer" class="btn btn-primary btn-sm ui-button">
								<i class="fas fa-cog fa-sm"></i>
							</button>
						</div>
						<div class="col-3">
							<input
								placeholder="identifiant"
								type="text"
								v-model.trim="etagere.identifiant"
								class="form-control form-control-sm"
							/>
						</div>
						<div class="col-1">
							<button @click="ajouter" class="btn btn-primary btn-sm">
								<i class="fas fa-plus-circle fa-sm"></i>
							</button>
						</div>
					</div>
					<!-- visualisation des données d'étagères -->
					<div style="margin-top: 3%" v-if="etageres[zoneEncour.identifiant].length > 0" class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<th>Nom</th>
									<th>Identifiant</th>
								</thead>
								<tbody>
									<tr v-for="element in etageres[zoneEncour.identifiant]" :key="element.id">
										<td>{{ element.nom }}</td>
										<td>{{ element.identifiant }}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-10"></div>
						<div class="col-md-2">
							<button @click="nextEtagere" class="btn btn-primary btn-sm ui-button">ok</button>
						</div>
					</div>
				</div>
			</div>
			<div v-else class="row">
				<!-- formulaire d'enregistrement des étagères avec visualisation des données -->
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<!-- formulaire -->
					<div class="form-row">
						<div class="col-7">
							<input
								ref="nom"
								placeholder="Nom d'étagère"
								type="text"
								v-model.trim="etagere.nom"
								class="form-control form-control-sm"
							/>
						</div>
						<div class="col-1">
							<button @click="generer" class="btn btn-primary btn-sm ui-button">
								<i class="fas fa-cog fa-sm"></i>
							</button>
						</div>
						<div class="col-3">
							<input
								placeholder="identifiant"
								type="text"
								v-model.trim="etagere.identifiant"
								class="form-control form-control-sm"
							/>
						</div>
						<div class="col-1">
							<button @click="add" class="btn btn-primary btn-sm">
								<i class="fas fa-plus-circle fa-sm"></i>
							</button>
						</div>
					</div>
					<!-- visualisation des données d'étagères -->
					<div v-if="etageres.length > 0" style="margin-top: 3%" class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<th>Nom</th>
									<th>Identifiant</th>
								</thead>
								<tbody>
									<tr v-for="element in etageres" :key="element.identifiant">
										<td>{{ element.nom }}</td>
										<td>{{ element.identifiant }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
		<div class="card-footer">
			<div style="float:right">
				<button @click="suivant" class="btn btn-outline-primary btn-sm">
					suivant
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import store from "./store"
//fonction permettant de vérifier si l'identifiant ou le nom de l'étagère existe déjà
const duplicate = function(newEtagere, etageres) {
	let found = false
	let message = ""
	let etageresWithoutKey = []
	for (const key in etageres) {
		if (Object.hasOwnProperty.call(etageres, key)) {
			etageresWithoutKey.push(etageres[key])
		}
	}
	const etageresFlat = etageresWithoutKey.flat()
	if (etageresFlat.length > 0) {
		etageresFlat.forEach(etagere => {
			if (etagere.identifiant === newEtagere.identifiant || etagere.nom === newEtagere.nom) {
				if (etagere.identifiant === newEtagere.identifiant)
					message += `Cet identifiant "${etagere.identifiant}" existe déjà.`
				if (etagere.nom === newEtagere.nom) message += `Le nom de étagère "${etagere.nom}" existe déjà.`
				found = true
			}
		})
	}
	return { found, message }
}
const duplicateWithoutZone = function(newEtagere, etageres) {
	let found = false
	let message = ""
	if (etageres.length > 0) {
		etageres.forEach(etagere => {
			if (etagere.identifiant === newEtagere.identifiant || etagere.nom === newEtagere.nom) {
				if (etagere.identifiant === newEtagere.identifiant)
					message += `Identifiant "${etagere.identifiant}" existe déjà.`
				if (etagere.nom === newEtagere.nom) message += `Le nom de étagère "${etagere.nom}" existe déjà.`
				found = true
			}
		})
	}
	return { found, message }
}
export default {
	computed: {
		//retourné les zones déjà pour lesquelles des étagères on déjà été crée
		zonesDone: function() {
			return this.zonesEnabled.filter(function(zone) {
				return zone.status === "done"
			})
		},
	},
	data() {
		return {
			checked: false,
			zonesDisabled: [],
			zoneEncour: {},
			compteur: 1,
			zonesEnabled: [],
			etagere: {
				nom: null,
				identifiant: null,
				id: null,
			},
			etageres: {},
		}
	},
	mounted() {
		console.log(store.state)
		this.zonner()
		console.log(store.state)
	},
	methods: {
		suivant() {
			store.state.etageres = JSON.parse(JSON.stringify(this.etageres))
			this.$root.$emit("third-to-last")
		},
		vider() {
			this.etagere = {
				nom: null,
				identifiant: null,
				id: null,
			}
		},
		add() {
			const { nom, identifiant } = this.etagere
			if (nom.length > 0 && identifiant.length > 0) {
				if (!this.foundOnServer()) {
					const { found, message } = duplicateWithoutZone(this.etagere, this.etageres)
					if (!found) {
						this.etageres.push({ nom, identifiant, id: this.compteur })
						this.compteur++
						this.vider()
					} else {
						this.notifier(message, "ATTENTION", "warning")
					}
					this.$refs.nom.focus()
				} else {
					this.vider()
					this.notifier("veuillez renseigner à nouveau l'étagère", "DUPLICATION DETECTEE", "warning")
				}
			}
		},
		ajouter() {
			const { nom, identifiant } = this.etagere
			if (nom.length > 0 && identifiant.length > 0) {
				if (!this.foundOnServer()) {
					const { found, message } = duplicate(this.etagere, this.etageres)
					if (!found) {
						this.etageres[this.zoneEncour.identifiant].push({ nom, identifiant, id: this.compteur })
						this.compteur++
						this.vider()
					} else {
						this.notifier(message, "ATTENTION", "warning")
					}
					this.$refs.nom.focus()
				} else {
					this.vider()
					this.notifier("veuillez renseigner à nouveau l'étagère", "DUPLICATION DETECTEE", "warning")
				}
			}
		},
		zonner() {
			const zones = store.state.zones
			if (zones.length > 1) {
				const calebasse = zones.reverse()
				let popped = calebasse.pop()
				popped.status = "loading"
				this.zoneEncour = popped
				this.etageres = { [this.zoneEncour.identifiant]: [] }
				this.zonesEnabled.push(popped)
				calebasse.length > 0 ? (this.zonesDisabled = calebasse) : (this.zonesDisabled = [])
			} else if (zones.length === 1) {
				this.zoneEncour = zones[0]
				this.zonesEnabled.push(zones[0])
				this.etageres = { [this.zoneEncour.identifiant]: [] }
			} else {
				this.etageres = []
			}
		},
		nextEtagere() {
			this.vider()
			this.zonesEnabled.forEach(zone => {
				zone.status = "done"
			})
			const zonesRest = this.zonesDisabled
			if (zonesRest.length > 0) {
				const calebasse = zonesRest.reverse()
				let popped = calebasse.pop()
				popped.status = "loading"
				this.zoneEncour = popped
				const marmite = this.etageres
				this.etageres = { ...marmite, [this.zoneEncour.identifiant]: [] }
				this.zonesEnabled.push(popped)
				calebasse.length > 0 ? (this.zonesDisabled = calebasse) : (this.zonesDisabled = [])
			} else {
				this.zoneEncour = {}
				this.suivant()
			}
			store.state.zones = JSON.parse(JSON.stringify(this.zonesEnabled))
		},
		generer() {
			axios
				.get("/systeme/async/magasin/generer/code-etagere")
				.then(result => {
					const { found, code } = result.data
					if (!found) {
						this.etagere.identifiant = code
					}
				})
				.catch(err => {
					console.log(err)
				})
		},
		foundOnServer() {
			axios
				.get("/systeme/async/magasin/find/code-etagere/" + this.etagere.identifiant)
				.then(result => {
					return result.data
				})
				.catch(err => {
					console.log(err)
				})
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
