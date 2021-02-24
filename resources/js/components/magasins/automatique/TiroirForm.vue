<template>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-10">
					<h5 class="text-primary">Création des tiroirs</h5>
				</div>
				<!-- <div class="col-md-2">
					<button @click="changeMode" class="btn btn-primary btn-sm ui-button">{{ modeName }}</button>
				</div> -->
			</div>
			<hr />
			<!-- visualisation des données -->
			<tree-view :key="manuel" />
		</div>
		<div class="card-footer">
			<div style="float:left">
				<button @click="precedant" class="btn btn-outline-primary btn-sm">
					precedant
				</button>
			</div>
			<div style="float:right">
				<button @click="suivant" class="btn btn-outline-primary btn-sm">
					terminer
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import store from "../store"
import TreeView from "./TreeView"

export default {
	components: {
		TreeView,
	},
	computed: {
		modeName: function() {
			return this.manuel ? "Manuel" : "Automatique"
		},
	},
	data() {
		return {
			tiroirs: [],
			manuel: false,
		}
	},
	methods: {
		suivant() {
			const message = "Impossible de continuer car aucun tiroir n'a été crée"
			Object.keys(store.state.tiroirs).length > 0
				? this.$emit("finish")
				: this.notifier(message, "OPERATION ECHOUEE", "danger")
		},
		precedant() {
			store.state.tiroirs = {}
			this.$emit("last-to-third")
		},
		// changeMode() {
		// 	store.state.tiroirs = {}
		// 	store.state.manuel = !store.state.manuel
		// 	this.manuel = store.state.manuel
		// 	return this.manuel
		// },
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
