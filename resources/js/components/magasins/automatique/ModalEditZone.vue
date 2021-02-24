<template>
	<b-modal
		@close="initialiser"
		@cancel="initialiser"
		@ok.prevent="editer"
		:id="formatId"
		title="création de tiroir automatique"
	>
		<div class="form-group">
			<label for="nom">Nom:</label>
			<input v-model="zone.nom" id="nom" type="text" class="form-control form-control-sm" />
		</div>
		<div class="form-group">
			<label for="identifiant">Identifiant:</label>
			<input v-model="zone.identifiant" id="identifiant" type="text" class="form-control form-control-sm" />
		</div>
	</b-modal>
</template>

<script>
import { BModal } from "bootstrap-vue"
export default {
	props: {
		zoneOld: Object,
	},
	computed: {
		formatId() {
			return "modal-" + this.zoneOld.id
		},
	},
	components: {
		BModal,
	},
	mounted() {
		this.initialiser()
	},
	data() {
		return {
			zone: {
				nom: null,
				identifiant: null,
				id: null,
			},
		}
	},
	methods: {
		editer() {
			console.log("editer is runing")
			if (this.zoneOld.nom !== this.zone.nom || this.zoneOld.identifiant !== this.zone.identifiant) {
				if (this.zone.nom !== null && this.zone.identifiant !== null) {
					this.$emit("zone-edit", this.zone)
				} else {
					this.notifier()
				}
			}
			this.$nextTick(() => {
				this.$bvModal.hide("modal-" + this.zoneOld.id)
			})
		},
		initialiser() {
			this.zone = {
				nom: this.zoneOld.nom,
				identifiant: this.zoneOld.identifiant,
				id: this.zoneOld.id,
			}
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
