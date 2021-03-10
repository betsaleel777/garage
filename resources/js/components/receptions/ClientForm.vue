<template>
	<div>
		<div class="row">
			<div v-if="!nouveau_client" class="col-md-5">
				<div class="row">
					<div v-if="!nouveau_client" class="col-md-4">
						<button type="button" @click="nouveau_client = true" class="btn btn-primary btn-flat">
							Nouveau client
						</button>
					</div>
					<div class="col-md-8">
						<div class="form-group input-group">
							<cool-select
								v-model="critere"
								:items="suggestions"
								placeholder="rechercher ancien client"
							/>
							<span class="input-group-append">
								<button @click="rechercher" type="button" class="btn btn-primary btn-flat">
									<i class="fas fa-search"></i>
								</button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div v-if="nouveau_client" class="col-md-7">
				<div class="row">
					<div class="col-md-3">
						<label for="">Type de client</label>
					</div>
					<div class="col-md-7">
						<div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									:disabled="disabled_particulier"
									type="radio"
									@change="cocher"
									name="kind"
									id="inlineradio1"
									value="particulier"
									v-model="kind"
								/>
								<label class="form-check-label" for="inlineradio1">Particulier</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									:disabled="disabled_entreprise"
									type="radio"
									@change="cocher"
									name="kind"
									id="inlineradio2"
									value="entreprise"
									v-model="kind"
								/>
								<label class="form-check-label" for="inlineradio2">Entreprise</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									class="form-check-input"
									:disabled="disabled_assurance"
									type="radio"
									@change="cocher"
									name="kind"
									id="inlineradio3"
									value="assurance"
									v-model="kind"
								/>
								<label class="form-check-label" for="inlineradio3">Assurance</label>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<button @click="etat_initial" type="button" class="btn btn-danger btn-sm ui-button">
							retour
						</button>
					</div>
				</div>
			</div>
		</div>
		<div v-if="particulier" class="row">
			<div class="form-group col-md-4">
				<label for="nom">Nom complet</label>
				<input name="nom_complet" v-model="client.nom_complet" class="form-control form-control-sm" id="nom" />
			</div>
			<div class="form-group col-md-4">
				<label for="telephone">Téléphone</label>
				<input
					name="telephone"
					v-model="client.telephone"
					class="form-control form-control-sm"
					id="telephone"
				/>
			</div>
			<div class="form-group col-md-4">
				<label for="email">Email</label>
				<input
					name="email"
					type="email"
					v-model="client.email"
					class="form-control form-control-sm"
					id="email"
				/>
			</div>
		</div>
		<div v-if="assurance" class="row">
			<div class="form-group col-md-6">
				<label for="nom_assurance">Nom de l'assurance</label>
				<input
					name="nom_assurance"
					v-model="client.nom_assurance"
					class="form-control form-control-sm"
					id="nom_assurance"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="representant_assurance">Nom du représentant de l'assurance</label>
				<input
					name="representant_assurance"
					v-model="client.representant_assurance"
					class="form-control form-control-sm"
					id="representant_assurance"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="contact_assurance">Contact Assurance</label>
				<input
					name="contact_assurance"
					v-model="client.contact_assurance"
					class="form-control form-control-sm"
					id="contact_assurance"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="email_assurance">Email Assurance</label>
				<input
					name="email_assurance"
					v-model="client.email_assurance"
					class="form-control form-control-sm"
					id="email_assurance"
				/>
			</div>
		</div>
		<div v-if="entreprise" class="row">
			<div class="form-group col-md-6">
				<label for="nom_entreprise">Nom de l'entreprise</label>
				<input
					name="nom_entreprise"
					v-model="client.nom_entreprise"
					class="form-control form-control-sm"
					id="nom_entreprise"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="representant_entreprise">Nom du représentant de l'entreprise</label>
				<input
					name="representant_entreprise"
					v-model="client.representant_entreprise"
					class="form-control form-control-sm"
					id="representant_entreprise"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="contact_entreprise">Contact entreprise</label>
				<input
					name="contact_entreprise"
					v-model="client.contact_entreprise"
					class="form-control form-control-sm"
					id="contact_entreprise"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="email_entreprise">Email entreprise</label>
				<input
					name="email_entreprise"
					v-model="client.email_entreprise"
					class="form-control form-control-sm"
					id="email_entreprise"
				/>
			</div>
		</div>
	</div>
</template>

<script>
import store from "./Store"
import { CoolSelect } from "vue-cool-select"
import "vue-cool-select/dist/themes/bootstrap.css"
export default {
	components: {
		CoolSelect,
	},
	props: {
		errors: {
			type: [Object, Array],
		},
	},
	mounted() {
		axios
			.get("/systeme/async/personne/suggestions")
			.then(result => {
				this.suggestions = result.data.suggestions ? result.data.suggestions : []
			})
			.catch(err => {})
	},
	updated() {
		store.state.client = this.client
	},
	data() {
		return {
			suggestions: [],
			particulier: false,
			assurance: false,
			entreprise: false,
			nouveau_client: false,
			kind: null,
			critere: "",
			client: {
				nom_complet: "",
				telephone: "",
				email: "",
				nom_assurance: "",
				representant_assurance: "",
				contact_assurance: "",
				email_assurance: "",
				nom_entreprise: "",
				representant_entreprise: "",
				contact_entreprise: "",
				email_entreprise: "",
			},
			disabled_particulier: false,
			disabled_assurance: false,
			disabled_entreprise: false,
		}
	},
	methods: {
		cocher() {
			if (this.kind === "assurance") {
				this.assurance = true
				this.particulier = !this.assurance
				this.entreprise = !this.assurance
				this.vider_particulier()
				this.vider_entreprise()
			} else if (this.kind === "entreprise") {
				this.entreprise = true
				this.particulier = !this.entreprise
				this.assurance = !this.entreprise
				this.vider_assurance()
				this.vider_particulier()
			} else {
				this.particulier = true
				this.entreprise = !this.particulier
				this.assurance = !this.particulier
				this.vider_assurance()
				this.vider_entreprise()
			}
		},
		rechercher() {
			axios
				.get("/systeme/async/personne/find/" + this.critere)
				.then(result => {
					let { personne, vehicule, nature } = result.data
					let vehiculeFound = { immatriculation: "" }
					if (vehicule) {
						vehiculeFound.immatriculation = vehicule.immatriculation
					}
					if (personne) {
						this.nouveau_client = true
						this.$root.$emit("ancien-gear", personne.id, vehiculeFound.immatriculation)
						if (nature === "assurance") {
							this.kind = "assurance"
							this.assurance = true
							this.particulier = false
							this.entreprise = false
							this.disabled_particulier = true
							this.disabled_entreprise = true
							this.client.contact_assurance = personne.contact_assurance
							this.client.email_assurance = personne.email_assurance
							this.client.nom_assurance = personne.nom_assurance
							this.client.representant_assurance = personne.representant_assurance
						} else if (nature === "entreprise") {
							this.kind = "entreprise"
							this.entreprise = true
							this.particulier = false
							this.assurance = false
							this.disabled_assurance = true
							this.disabled_particulier = true
							this.client.contact_entreprise = personne.contact_entreprise
							this.client.email_entreprise = personne.email_entreprise
							this.client.nom_entreprise = personne.nom_entreprise
							this.client.representant_entreprise = personne.representant_entreprise
						} else {
							this.kind = "particulier"
							this.particulier = true
							this.entreprise = false
							this.assurance = false
							this.disabled_assurance = true
							this.disabled_entreprise = true
							this.client.nom_complet = personne.nom_complet
							this.client.telephone = personne.telephone
							this.client.email = personne.email
						}
					} else {
						this.$bvToast.toast("Aucun client correspondant à ce critère n'as été trouvé", {
							title: "INFORMATION",
							solid: true,
							variant: "info",
						})
					}
				})
				.catch(err => {})
		},
		vider_assurance() {
			this.client.representant_assurance = null
			this.client.contact_assurance = null
			this.client.nom_assurance = null
			this.client.email_assurance = null
		},
		vider_particulier() {
			this.client.nom_complet = null
			this.client.email = null
			this.client.telephone = null
		},
		vider_entreprise() {
			this.client.nom_entreprise = null
			this.client.contact_entreprise = null
			this.client.email_entreprise = null
			this.client.representant_entreprise = null
		},
		etat_initial() {
			this.nouveau_client = false
			this.particulier = false
			this.assurance = false
			this.entreprise = false
			this.kind = null
			this.critere = ""
			this.client.nom_complet = ""
			this.client.telephone = ""
			this.client.email = ""
			this.client.nom_assurance = ""
			this.client.representant_assurance = ""
			this.client.contact_assurance = ""
			this.client.email_assurance = ""
			this.client.nom_entreprise = ""
			this.client.representant_entreprise = ""
			this.client.contact_entreprise = ""
			this.client.email_entreprise = ""
			this.disabled_particulier = false
			this.disabled_assurance = false
			this.disabled_entreprise = false
			this.$root.$emit("reset")
		},
	},
}
</script>

<style></style>
