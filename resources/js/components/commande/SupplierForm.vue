<template>
	<div class="form-row">
		<div class="col-11">
			<label for="fournisseur">Fournisseur</label>
			<vue-select v-model="fournisseur" id="fournisseur" :options="fournisseurs"></vue-select>
			<span v-if="error.exist" class="text-danger">
				<small>{{ error.value }}</small>
			</span>
		</div>
		<div class="col-1">
			<modal-fournisseur />
		</div>
	</div>
</template>

<script>
import VueSelect from "vue-select"
import store from "./store"
import ModalFournisseur from "./ModalFournisseur"
export default {
	components: {
		VueSelect,
		ModalFournisseur,
	},
	props: {
		fournisseurs: {
			type: [Array, Object],
			required: true,
		},
		error: Object,
	},
	updated() {
		store.state.fournisseur = this.fournisseur
	},
	mounted() {
		this.fournisseur = store.state.fournisseur
	},
	data() {
		return {
			fournisseur: "",
			modalShow: false,
		}
	},
	methods: {},
}
</script>

<style></style>
