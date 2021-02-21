<template>
	<form enctype="multipart/form-data" method="POST">
		<div class="row">
			<div class="col-md-12">
				<div style="margin-bottom: 3%">
					<h5 class="text-primary">Informations du client</h5>
					<hr />
					<client-form />
				</div>
			</div>
			<ancien-vehicule-form
				v-if="ancien_gear"
				:matricule="matricule"
				:personne="personne"
				:enjoliveurs="enjoliveurs"
			/>
			<div style="margin-bottom:2%" class="col-md-12">
				<h5 class="text-primary">Informations du véhicule</h5>
				<hr />
				<vehicule-form v-if="!ancien_gear" :types_vehicules="types_vehicules" :enjoliveurs="enjoliveurs" />
			</div>
			<!-- checklist -->
			<checklist-form />
			<commentaire-reception />
		</div>
		<div style="text-align: right" class="form-group">
			<button @click="envoyer" type="button" class="btn btn-primary">
				enregistrer
			</button>
		</div>
	</form>
</template>

<script>
import ClientForm from "./ClientForm"
import AncienVehiculeForm from "./AncienVehiculeForm"
import VehiculeForm from "./VehiculeInfoForm"
import ChecklistForm from "./ChecklistForm"
import CommentaireReception from "./CommentaireReceptionForm"
import store from "./Store"
export default {
	props: {
		types_vehicules: Array,
		enjoliveurs: {
			type: [Array, Object],
		},
	},
	components: {
		ClientForm,
		AncienVehiculeForm,
		VehiculeForm,
		ChecklistForm,
		CommentaireReception,
	},
	mounted() {
		this.$root.$on("nouveau-vehicule", () => {
			this.ancien_gear = false
		})
		this.$root.$on("ancien-gear", (personne, matricule) => {
			this.ancien_gear = true
			this.personne = personne
			this.matricule = String(matricule)
		})
	},
	data() {
		return {
			ancien_gear: false,
			personne: null,
			matricule: null,
		}
	},
	methods: {
		envoyer(event) {
			event.preventDefault()
			const { commentaire, infos, client, checklist, ancien } = store.state
			let postObject = {}
			console.log(ancien, infos)
			if (Object.keys(ancien).length === 0) {
				console.log("ancien vide")
				postObject = {
					...commentaire,
					...infos,
					...checklist,
					...client,
				}
			} else {
				console.log("ancien rempli")
				postObject = {
					...commentaire,
					...ancien,
					...checklist,
					...client,
				}
			}
			axios
				.post("/maintenance/reception/store", postObject)
				.then(result => {
					location.href = "/maintenance/reception/liste"
				})
				.catch(err => {
					this.$root.$emit("delete-errors")
					const { errors } = err.response.data
					this.$root.$emit("probleme", errors)
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
