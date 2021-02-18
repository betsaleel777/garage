<template>
	<div>
		<a class="text-primary" @click="runModal"><i class="fas fa-lg fa-plus-circle"></i></a>
		<b-modal
			@ok="enregistrer"
			size="lg"
			:id="`add-${bigreception.id}`"
			:title="`Essais de la réception ${bigreception.code}`"
		>
			<div class="form-group">
				<label>Ressenti Client</label>
				<p>
					<small>{{ bigreception.ressenti }}</small>
				</p>
				<label>Commentaire du réceptioniste</label>
				<p>
					<small>{{ bigreception.commentaire.contenu }}</small>
				</p>
			</div>
			<div class="form-group">
				<label for="ressenti">Ressenti Essayeur</label>
				<textarea class="form-control" v-model="commentaire" id="ressenti" cols="30" rows="6"></textarea>
				<span v-if="messages.ressenti.exist" class="text-danger">{{ messages.ressenti.value }}</span>
			</div>
			<template #modal-footer="{ok,cancel}">
				<button @click="showReception" class="btn btn-warning">
					détails véhicule
				</button>
				<button @click="cancel()" class="btn btn-secondary">
					cancel
				</button>
				<button @click="ok()" class="btn btn-primary">ok</button>
			</template>
		</b-modal>
		<modal-detail-reception :reception="bigreception" />
	</div>
</template>

<script>
import BVModal from "bootstrap-vue"
import ModalDetailReception from "../ModalDetailReception"
export default {
	components: {
		BVModal,
		ModalDetailReception,
	},
	props: {
		bigreception: Object,
	},
	data() {
		return {
			commentaire: "",
			messages: {
				ressenti: {
					exist: false,
					value: null,
				},
			},
		}
	},
	mounted() {},
	methods: {
		runModal() {
			this.$bvModal.show("add-" + this.bigreception.id)
		},
		enregistrer(event) {
			event.preventDefault()
			axios
				.post("/maintenance/essai/pre/store", {
					reception: this.bigreception.id,
					commentaire: this.commentaire,
				})
				.then(result => {
					location.reload()
				})
				.catch(err => {
					this.messages.ressenti.exist = true
					this.messages.ressenti.value = err.response.data.errors.commentaire[0]
				})
		},
		showReception() {
			this.$bvModal.show("detail-reception-" + this.bigreception.id)
		},
	},
}
</script>

<style></style>
