<template>
	<div class="form-row">
		<div class="col-12">
			<label for="pieces">Pieces</label>
			<multiselect
				@select="addToTable"
				@remove="removeToTable"
				id="pieces"
				v-model="value"
				tag-placeholder="selectioner cette piece"
				placeholder="rechercher ou ajouter une pièce"
				label="name"
				track-by="code"
				:options="options"
				:multiple="true"
				:taggable="true"
				@tag="addTag"
			></multiselect>
		</div>
		<!-- <div class="col-1">
			<button @click="sendToTable" type="button" class="btn btn-primary btn-flat btn-sm ui-button">
				<i class="fas fa-plus-circle fa-lg"></i>
			</button>
		</div> -->
		<div class="col-12">
			<piece-table :key="cle" />
		</div>
	</div>
</template>

<script>
import Multiselect from "vue-multiselect"
import PieceTable from "./PiecesTable"
import store from "./store"
export default {
	components: {
		Multiselect,
		PieceTable,
	},
	props: {
		pieces: {
			type: [Array, Object],
			required: true,
		},
	},
	mounted() {
		this.options = this.pieces
	},
	data() {
		return {
			options: [],
			cle: false,
			value: [],
		}
	},
	methods: {
		addToTable(option) {
			const calebasse = option.name.split(".")
			const reference = calebasse[0]
			const nom = calebasse[1]
			store.state.pieces.push({
				code: option.code,
				reference: reference,
				name: nom,
				achat: 0,
				vente: 0,
				quantite: 0,
			})
			this.cle = !this.cle
		},
		removeToTable(option) {
			store.state.pieces = store.state.pieces.filter(item => item.code !== option.code)
			this.cle = !this.cle
		},
		addTag(newTag) {
			const tag = {
				label: newTag,
				code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
			}
			this.options.push(tag)
			this.value.push(tag)
		},
	},
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style></style>
