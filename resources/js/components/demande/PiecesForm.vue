<template>
	<div class="container">
		<div class="form-group">
			<div class="form-group">
				<label for="pieces">Pieces</label>
				<multiselect
					@select="addToTable"
					@remove="removeToTable"
					id="pieces"
					v-model="piecesSelected"
					tag-placeholder="selectioner cette piece"
					placeholder="rechercher ou ajouter une pièce"
					label="name"
					track-by="code"
					:options="pieces"
					:multiple="true"
					:taggable="true"
					@tag="addTag"
				></multiselect>
			</div>
		</div>
		<div class="form-group">
			<pieces-table :key="refresh" />
		</div>
	</div>
</template>

<script>
import store from "./store"
import Multiselect from "vue-multiselect"
import PiecesTable from "./PiecesTable"
export default {
	components: {
		Multiselect,
		PiecesTable,
	},
	mounted() {
		this.pieces = store.state.pieces
	},
	data() {
		return {
			piecesSelected: [],
			pieces: [],
			refresh: false,
		}
	},
	methods: {
		addToTable(option) {
			const calebasse = option.name.split(".")
			const reference = calebasse[0]
			const nom = calebasse[1]
			store.state.rowPieces.push({
				code: option.code,
				reference: reference,
				vehicule: option.vehicule,
				name: nom,
				quantite: 0,
			})
			this.refresh = !this.refresh
		},
		removeToTable(option) {
			store.state.rowPieces = store.state.rowPieces.filter(item => item.code !== option.code)
			this.refresh = !this.refresh
		},
		addTag(newTag) {
			const tag = {
				label: newTag,
				code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
			}
			this.pieces.push(tag)
			this.piecesSelected.push(tag)
		},
	},
}
</script>

<style></style>
