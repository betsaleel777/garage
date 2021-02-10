<template>
	<div class="card">
		<div class="card-body">
			<h5 class="text-primary">Création des tiroirs</h5>
			<hr />
			<!-- visualisation des données -->
			<recapitulatif-tab />
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
import RecapitulatifTab from "./RecapitulatifTab"
export default {
	components: {
		RecapitulatifTab,
	},
	data() {
		return {
			tiroirs: [],
			etageres: [],
		}
	},
	mounted() {
		this.etageres = store.state.etageres
	},
	methods: {
		suivant() {},
	},
}
</script>

<style></style>
