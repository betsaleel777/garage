<template>
	<form action="">
		<div class="form-group">
			<label for="nom">Nom de tiroir</label>
			<input class="form-control form-control-sm" id="nom" v-model.trim="tiroir.nom" type="text" />
			<small>
				<span class="text-danger" v-if="messages.nom.exist">{{ messages.nom.value }}</span>
			</small>
		</div>
		<div class="form-group">
			<label for="identifiant">Identifiant du tiroir</label>
			<input
				class="form-control form-control-sm"
				id="identifiant"
				v-model.trim="tiroir.identifiant"
				type="text"
			/>
			<small>
				<span class="text-danger" v-if="messages.identifiant.exist">{{ messages.identifiant.value }}</span>
			</small>
		</div>
		<div style="text-align: right" class="form-group">
			<button @click="enregistrer" type="button" class="btn btn-primary">Enregistrer</button>
		</div>
	</form>
</template>

<script>
export default {
	props: {
		etagere: {
			type: Number,
			required: true,
		},
	},
	data() {
		return {
			tiroir: {
				nom: null,
				identifiant: null,
			},
			messages: {
				nom: {
					exist: false,
					value: null,
				},
				identifiant: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		enregistrer() {
			const { nom, identifiant } = this.tiroir
			axios
				.post("/systeme/tiroir/store/manuel", { nom, identifiant, etagere: this.etagere })
				.then(result => {
					this.$bvModal
						.msgBoxConfirm("Voulez créer un tiroir à nouveau ?", {
							title: "Confirmation",
							size: "sm",
							buttonSize: "sm",
							okVariant: "primary",
							okTitle: "Continuer",
							cancelTitle: "Ne pas continuer",
							footerClass: "p-2",
							hideHeaderClose: false,
							centered: true,
						})
						.then(value => {
							value ? location.reload() : (location.href = "/systeme/tiroir/etagere/" + this.etagere)
						})
						.catch(err => {})
				})
				.catch(err => {
					const { errors } = err.response.data
					if (errors.nom) {
						this.messages.nom.exist = true
						this.messages.nom.value = errors.nom[0]
					}
					if (errors.identifiant) {
						this.messages.identifiant.exist = true
						this.messages.identifiant.value = errors.identifiant[0]
					}
				})
		},
	},
}
</script>

<style></style>
