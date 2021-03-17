<template>
	<form action="">
		<div class="form-group">
			<label for="nom">Nom de l'étagère</label>
			<input class="form-control form-control-sm" id="nom" v-model.trim="etagere.nom" type="text" />
			<small>
				<span class="text-danger" v-if="messages.nom.exist">{{ messages.nom.value }}</span>
			</small>
		</div>
		<div class="form-group">
			<label for="identifiant">Identifiant de l'étagère</label>
			<input
				class="form-control form-control-sm"
				id="identifiant"
				v-model.trim="etagere.identifiant"
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
		zone: {
			type: Number,
			required: true,
		},
	},
	data() {
		return {
			etagere: {
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
			const { nom, identifiant } = this.etagere
			axios
				.post("/systeme/etagere/store/manuel", { nom, identifiant, zone: this.zone })
				.then(result => {
					this.$bvModal
						.msgBoxConfirm("Voulez vous continuer vers la création des tiroirs?", {
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
							value
								? (location.href = "/projects/garage/systeme/tiroir/etagere/" + result.data.id)
								: (location.href = "/projects/garage/systeme/etagere/zone/" + this.zone)
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
