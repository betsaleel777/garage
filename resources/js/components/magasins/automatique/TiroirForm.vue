<template>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-10">
					<h5 class="text-primary">Création des tiroirs</h5>
				</div>
			</div>
			<hr />
			<!-- visualisation des données -->
			<tree-view />
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
	data() {
		return {
			tiroirs: [],
		}
	},
	methods: {
		suivant() {
			const message = "Impossible de continuer car aucun tiroir n'a été crée"
			Object.keys(store.state.tiroirs).length > 0
				? this.$root.$emit("finish")
				: this.notifier(message, "OPERATION ECHOUEE", "danger")
		},
		precedant() {
			store.state.tiroirs = {}
			this.$emit("last-to-third")
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
