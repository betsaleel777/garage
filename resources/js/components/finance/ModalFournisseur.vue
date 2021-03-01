<template>
	<div>
		<button @click="modalShow = !modalShow" type="button" class="btn btn-primary btn-flat btn-sm">
			<i class="fas fa-plus-circle"></i>
		</button>
		<b-modal
			@ok="enregistrer"
			@hide="reinitialiser"
			@cancel="reinitialiser"
			v-model="modalShow"
			title="Créer un fournisseur"
		>
			<div class="form-group">
				<label for="nom">Nom</label>
				<input type="text" class="form-control form-control-sm" v-model="fournisseur.nom" id="nom" />
				<span class="text-danger" v-if="messages.nom.exist"
					><small>{{ messages.nom.value }}</small></span
				>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control form-control-sm" v-model="fournisseur.email" id="email" />
				<span class="text-danger" v-if="messages.email.exist"
					><small>{{ messages.email.value }}</small></span
				>
			</div>
			<div class="form-group">
				<label for="contact">Contact</label>
				<input type="text" class="form-control form-control-sm" v-model="fournisseur.contact" id="contact" />
				<span class="text-danger" v-if="messages.contact.exist"
					><small>{{ messages.contact.value }}</small></span
				>
			</div>
			<div class="form-group">
				<label for="siege">Siège</label>
				<input type="text" class="form-control form-control-sm" v-model="fournisseur.siege" id="siege" />
				<span class="text-danger" v-if="messages.siege.exist"
					><small>{{ messages.siege.value }}</small></span
				>
			</div>
		</b-modal>
	</div>
</template>

<script>
import { BModal } from "bootstrap-vue"
export default {
	components: {
		BModal,
	},
	data() {
		return {
			modalShow: false,
			fournisseur: {
				nom: "",
				siege: "",
				contact: "",
				email: "",
			},
			messages: {
				nom: {
					exist: false,
					value: null,
				},
				siege: {
					exist: false,
					value: null,
				},
				contact: {
					exist: false,
					value: null,
				},
				email: {
					exist: false,
					value: null,
				},
			},
		}
	},
	methods: {
		reinitialiser() {
			this.vider()
			this.viderErrors()
		},
		vider() {
			this.fournisseur = {
				nom: "",
				siege: "",
				contact: "",
				email: "",
			}
		},
		viderErrors() {
			this.messages = {
				nom: {
					exist: false,
					value: null,
				},
				siege: {
					exist: false,
					value: null,
				},
				contact: {
					exist: false,
					value: null,
				},
				email: {
					exist: false,
					value: null,
				},
			}
		},
		enregistrer(event) {
			event.preventDefault()
			axios
				.post("/systeme/fournisseur/storejs", { ...this.fournisseur })
				.then(result => {
					this.notifier(result.data.message, "OPERATION REUSSIE", "success")
					this.$root.$emit("supplier-added")
					this.$nextTick(() => {
						this.modalShow = false
					})
				})
				.catch(err => {
					const { errors } = err.response.data
					if (errors) {
						if (errors.nom) {
							this.messages.nom.exist = true
							this.messages.nom.value = errors.nom[0]
						}
						if (errors.email) {
							this.messages.email.exist = true
							this.messages.email.value = errors.email[0]
						}
						if (errors.contact) {
							this.messages.contact.exist = true
							this.messages.contact.value = errors.contact[0]
						}
						if (errors.siege) {
							this.messages.siege.exist = true
							this.messages.siege.value = errors.siege[0]
						}
					}
				})
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
