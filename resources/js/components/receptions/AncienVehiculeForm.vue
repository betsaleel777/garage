<template>
	<div class="col-md-12" style="margin-bottom:3%">
		<h5 class="text-primary">Anciens véhicules</h5>
		<hr />
		<div class="row">
			<div class="col-md-5">
				<div class="list-group">
					<a
						@click="ancienForm(element.id)"
						v-for="element in vehicules"
						:key="element.id"
						:class="{ 'list-group-item-primary': element.selected }"
						class="list-group-item list-group-item-action"
					>
						{{ element.nom }}
					</a>
					<a
						v-if="newVehicule"
						@click="emitNewVehicule"
						class="text-center text-primary list-group-item list-group-item-action list-group-item-light"
					>
						NOUVEAU VEHICULE
					</a>
				</div>
			</div>
			<div v-if="ancien_form_show" class="col-md-7">
				<div class="ancien">
					<div class="form-group form-row">
						<div class="col-6">
							<label for="">Nom du Déponsant</label>
							<input v-model="ancien.nom_deposant" type="text" class="form-control form-control-sm" />
						</div>
						<div class="col-6">
							<label for="">DMC</label>
							<input type="text" v-model="ancien.dmc" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group form-row">
						<div class="col-6">
							<label for="">Kilométrage actuel</label>
							<input
								v-model="ancien.kilometrage_actuel"
								type="text"
								class="form-control form-control-sm"
							/>
						</div>
						<div class="col-6">
							<label for="">Prochaine vidange</label>
							<input
								type="text"
								class="form-control form-control-sm"
								v-model="ancien.prochaine_vidange"
							/>
						</div>
					</div>
					<div class="form-group form-row">
						<div class="col-6">
							<label for="">Date sitca</label><br />
							<date-picker
								style="width:100%"
								id="date_sitca"
								input-class="form-control form-control-sm"
								v-model="ancien.date_sitca"
								format="DD-MM-YYYY"
								value-type="date"
							></date-picker>
						</div>
						<div class="col-6">
							<label for="">Date de fin assurance</label><br />
							<date-picker
								style="width:100%"
								id="date_assurance"
								input-class="form-control form-control-sm"
								v-model="ancien.date_assurance"
								format="DD-MM-YYYY"
								value-type="date"
							></date-picker>
						</div>
					</div>
					<div class="form-group form-row">
						<div class="col-6">
							<label>Niveau de carburant</label><br />
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									type="radio"
									v-model="ancien.niveau_carburant"
									id="ca1"
									value="0"
								/>
								<label class="form-check-label" for="ca1">0</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									type="radio"
									v-model="ancien.niveau_carburant"
									id="ca2"
									value="1/4"
								/>
								<label class="form-check-label" for="ca2">1/4</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									type="radio"
									v-model="ancien.niveau_carburant"
									id="ca3"
									value="1/2"
								/>
								<label class="form-check-label" for="ca3">1/2</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									type="radio"
									v-model="ancien.niveau_carburant"
									id="ca4"
									value="3/4"
								/>
								<label class="form-check-label" for="ca4">3/4</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									type="radio"
									v-model="ancien.niveau_carburant"
									id="ca5"
									value="1"
								/>
								<label class="form-check-label" for="ca5">1</label>
							</div>
						</div>
						<div class="col-6">
							<label>Enjoliveurs</label><br />
							<div v-for="element in enjoliveurs" :key="element.id" class="form-check form-check-inline">
								<input
									class="form-check-input"
									type="checkbox"
									:id="`en${element.id}`"
									:value="element.id"
									v-model="ancien.enjoliveur"
								/>
								<label class="form-check-label" :for="`en${element.id}`">{{ element.nom }} </label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import store from "./Store"
import DatePicker from "vue2-datepicker"
import "vue2-datepicker/index.css"
export default {
	components: {
		DatePicker,
	},
	props: {
		enjoliveurs: {
			type: [Object, Array],
		},
		personne: Number,
		matricule: String,
	},
	mounted() {
		axios
			.get("/systeme/async/vehicules/from/" + this.personne)
			.then(result => {
				const { vehicules } = result.data
				let selected = false
				let id = null
				this.vehicules = vehicules.map(vehicule => {
					if (this.matricule === vehicule.immatriculation) {
						selected = true
						id = vehicule.id
						this.newVehicule = false
					}
					return {
						nom: `${vehicule.marque} ${vehicule.modele} ${vehicule.type_vehicule}
                              ${vehicule.annee} ${vehicule.couleur}`,
						id: vehicule.id,
						selected,
					}
				})
				if (this.matricule !== "") {
					this.ancienForm(id)
				}
			})
			.catch(err => {})
	},
	updated() {
		store.state.ancien = this.ancien
	},
	destroyed() {
		store.state.ancien = {}
	},
	data() {
		return {
			ancien_gear: false,
			ancien_form_show: false,
			newVehicule: true,
			vehicules: [],
			ancien: {
				vide: true,
				vehicule: null,
				enjoliveur: [],
				nom_deposant: null,
				dmc: null,
				kilometrage_actuel: null,
				prochaine_vidange: null,
				date_assurance: null,
				date_sitca: null,
				niveau_carburant: null,
			},
		}
	},
	methods: {
		ancienForm(id) {
			this.ancien_form_show = true
			this.ancien.vehicule = id
			this.vehicules.forEach(vehicule => {
				vehicule.id === id ? (vehicule.selected = true) : (vehicule.selected = false)
			})
		},
		emitNewVehicule() {
			this.ancien_gear = false
			this.$root.$emit("nouveau-vehicule")
		},
	},
}
</script>

<style scoped>
.ancien {
	border: 2px solid;
	padding: 2%;
}
</style>
