<template>
	<div class="card">
		<div class="card-body">
			<h5 class="text-primary">Création des zones de stockage</h5>
			<hr />
			<div class="form-row">
				<div class="col-8">
					<input
						ref="nom"
						v-on:keyup.enter="ajouter"
						placeholder="Nom de la zone"
						type="text"
						v-model.trim="zone.nom"
						class="form-control form-control-sm"
					/>
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
					<button @click="ajouter" class="btn btn-primary btn-sm">
						<i class="fas fa-plus-circle fa-sm"></i>
					</button>
				</div>
			</div>
			<vue-custom-scrollbar class="scrollarea" :settings="options">
				<div style="margin-top: 3%" v-if="zones.length > 0" class="row">
					<div class="col-md-10">
						<small>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Nom</th>
										<th>Identifiant</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="element in zones" :key="element.identifiant">
										<td>{{ element.nom }}</td>
										<td>{{ element.identifiant }}</td>
									</tr>
								</tbody>
							</table>
						</small>
					</div>
				</div>
			</vue-custom-scrollbar>
		</div>
		<div class="card-footer">
			<div style="float:right">
				<button @click="suivant" class="btn btn-outline-primary btn-sm">
					{{ textButton }}
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import store from "./store"
import vueCustomScrollbar from "vue-custom-scrollbar"
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
			this.$root.$emit("second-to-third")
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
				const { found, message } = duplicate(this.zone, this.zones)
				!found
					? this.zones.push({ nom, identifiant, status: "not done" })
					: this.notifier(message, "ATTENTION", "warning")
				this.vider()
				this.$refs.nom.focus()
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
.scrollarea {
	height: 7.8em;
}
</style>
