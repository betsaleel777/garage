<template>
	<div class="row">
		<div class="col-md-6">
			<magasin-form />
		</div>
		<div class="col-md-6">
			<zone-form v-if="active.zone" />
		</div>
		<div class="col-md-12">
			<etagere-form v-if="active.etagere" />
		</div>
		<div class="col-md-12">
			<tiroir-form v-if="active.tiroir" />
		</div>
		<div style="margin-bottom:1%" class="col-md-2">
			<button type="button" @click="envoyer" class="btn btn-primary btn-sm ui-btn">
				enregistrer
			</button>
		</div>
	</div>
</template>

<script>
import store from "./store"
import MagasinForm from "./MagasinForm"
import ZoneForm from "./ZoneForm"
import EtagereForm from "./EtagereForm"
import TiroirForm from "./TiroirForm"

export default {
	components: {
		MagasinForm,
		ZoneForm,
		EtagereForm,
		TiroirForm,
	},
	mounted() {
		this.$root.$on("first-to-second", () => {
			this.active.zone = true
		})
		this.$root.$on("second-to-third", () => {
			this.active.etagere = true
		})
		this.$root.$on("third-to-last", () => {
			this.active.tiroir = true
		})
		this.$root.$on("finish", () => {
			this.envoyer()
		})
	},
	data() {
		return {
			active: {
				zone: false,
				etagere: false,
				tiroir: false,
			},
		}
	},
	methods: {
		envoyer() {
			const postObject = store.state
			const { magasin, etageres, tiroirs } = postObject
			let etagereValide = false
			if (etageres.constructor.name === "Array") {
				etagereValide = etageres.length > 0
			} else {
				etagereValide = Object.keys(etageres).length > 0
			}
			console.log(postObject)
			if (magasin.nom && magasin.lieu && etagereValide && Object.keys(tiroirs).length > 0) {
				axios
					.post("/systeme/magasin/storejs", { ...postObject })
					.then(result => {
						//rediriger vers le show du magasin
						//location.href = ""
					})
					.catch(err => {
						console.log(err)
					})
			}
		},
	},
}
</script>

<style></style>
