<template>
	<form action="">
		<div class="form-group">
			<label for="nom">Nom du magasin</label>
			<input class="form-control form-control-sm" id="nom" v-model.trim="magasin.nom" type="text" />
			<small>
				<span class="text-danger" v-if="messages.nom.exist">{{ messages.nom.value }}</span>
			</small>
		</div>
		<div class="form-group">
			<label for="lieu">Lieu de stockage</label>
			<input class="form-control form-control-sm" id="lieu" v-model.trim="magasin.lieu" type="text" />
			<small>
				<span class="text-danger" v-if="messages.lieu.exist">{{ messages.lieu.value }}</span>
			</small>
		</div>
		<div style="text-align: right" class="form-group">
			<button @click="enregistrer" type="button" class="btn btn-primary">Enregistrer</button>
		</div>
	</form>
</template>

<script>
export default {
	data() {
		return {
			magasin: {
				lieu: null,
				nom: null,
			},
			messages: {
				nom: {
					exist: false,
					value: null,
				},
				lieu: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		enregistrer() {
			const { nom, lieu } = this.magasin
			axios
				.post("/systeme/magasin/store/manuel", { nom, lieu })
				.then(result => {
					this.$bvModal
						.msgBoxConfirm("Voulez vous continuer vers la création des zones de stockage ?", {
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
								? (location.href = "/projects/garage/systeme/zone/magasin/" + result.data.id)
								: (location.href = "/projects/garage/systeme/magasin/index")
						})
						.catch(err => {})
				})
				.catch(err => {
					const { errors } = err.response.data
					if (errors.nom) {
						this.messages.nom.exist = true
						this.messages.nom.value = errors.nom[0]
					}
					if (errors.lieu) {
						this.messages.lieu.exist = true
						this.messages.lieu.value = errors.lieu[0]
					}
				})
		},
	},
}
</script>

<style></style>
