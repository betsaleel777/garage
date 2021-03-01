<template>
	<div class="form-row">
		<div class="col-11">
			<label for="fournisseur">Fournisseur</label>
			<vue-select v-model="fournisseur" id="fournisseur" :options="fournisseurs"></vue-select>
		</div>
		<div class="col-1">
			<modal-fournisseur />
		</div>
	</div>
</template>

<script>
import VueSelect from "vue-select"
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
