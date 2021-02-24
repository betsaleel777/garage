<template>
	<div class="row">
		<div class="col-md-6">
			<magasin-form @first-to-second="active.zone = true" />
		</div>
		<div class="col-md-6">
			<zone-form
				@second-to-third="active.etagere = true"
				@second-to-first="active.zone = false"
				:key="refresh.zone"
				v-if="active.zone"
			/>
		</div>
		<div class="col-md-12">
			<etagere-form
				@third-to-last="active.tiroir = true"
				:key="refresh.etagere"
				@third-to-second="onThirdSecond"
				v-if="active.etagere"
			/>
		</div>
		<div class="col-md-12">
			<tiroir-form @last-to-third="onLastthird" v-if="active.tiroir" />
		</div>
	</div>
</template>

<script>
import store from "../store"
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
			refresh: {
				zone: false,
				etagere: true,
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
						location.href = "/systeme/magasin/show/" + result.data.magasin
					})
					.catch(err => {
						console.log(err)
					})
			}
		},
		onThirdSecond() {
			this.active.etagere = false
			this.refresh.zone = !this.refresh.zone
		},
		onLastthird() {
			this.active.tiroir = false
			this.refresh.etagere = !this.refresh.etagere
		},
	},
}
</script>

<style></style>
