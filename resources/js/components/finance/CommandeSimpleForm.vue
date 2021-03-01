<template>
	<div class="container">
		<form action="" enctype="multipart/form-data">
			<div class="form-group">
				<label for="reference">Réference</label>
				<input class="form-control form-control-sm" type="text" id="reference" v-model="reference" />
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label for="magasin">Magasin</label>
						<vue-select v-model="magasin" id="magasin" :options="magasins"></vue-select>
					</div>
					<div class="col-md-6">
						<supplier-form :fournisseurs="suppliers" />
					</div>
				</div>
			</div>
			<h5 class="text-primary">Produits</h5>
			<hr />
			<div class="form-group">
				<products-form :pieces="pieces" />
			</div>
			<div class="form-group">
				<label for="notes">Notes</label>
				<textarea
					placeholder="remarque ou appréciations au sujet de cette commande"
					class="form-control form-control-sm"
					id="notes"
					cols="30"
					rows="4"
					v-model="notes"
				></textarea>
			</div>
		</form>
	</div>
</template>

<script>
import ProductsForm from "./ProductsForm"
import SupplierForm from "./SupplierForm"
import VueSelect from "vue-select"
export default {
	components: {
		ProductsForm,
		SupplierForm,
		VueSelect,
	},
	props: {
		pieces: {
			type: [Object, Array],
			required: true,
		},
		fournisseurs: {
			type: [Object, Array],
			required: true,
		},
		magasins: {
			type: [Object, Array],
			required: true,
		},
	},
	mounted() {
		this.suppliers = this.fournisseurs
		this.$root.$on("supplier-added", () => {
			this.refreshSupplier()
		})
	},
	data() {
		return {
			magasin: "",
			documents: [],
			reference: "",
			notes: "",
			suppliers: [],
			fournisseur: "",
		}
	},
	methods: {
		refreshSupplier() {
			axios
				.get("/systeme/fournisseur/all/select")
				.then(result => {
					this.suppliers = result.data.fournisseurs
				})
				.catch(err => {})
		},
	},
}
</script>

<style></style>
