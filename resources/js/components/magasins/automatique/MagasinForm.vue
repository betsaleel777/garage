<template>
	<div class="card">
		<div class="card-body">
			<div class="form-group">
				<h5 class="text-primary">Identification du magasin</h5>
				<hr />
				<small><label for="nom">Nom complet du magasin</label></small>
				<input
					v-model.trim="magasin.nom"
					v-on:keyup.enter="suivant"
					:class="{ 'is-invalid': $v.magasin.nom.$error }"
					class="form-control form-control-sm"
					@input="setName($event.target.value)"
					id="nom"
				/>
				<div v-if="!$v.magasin.nom.required" class="invalid-feedback">
					Le nom est requis
				</div>
			</div>
			<div class="form-group">
				<small><label for="lieu">Lieu</label></small>
				<input
					v-model.trim="magasin.lieu"
					v-on:keyup.enter="suivant"
					:class="{ 'is-invalid': $v.magasin.lieu.$error }"
					class="form-control form-control-sm"
					@input="setLieu($event.target.value)"
					id="lieu"
				/>
				<div v-if="!$v.magasin.lieu.required" class="invalid-feedback">
					le lieu d'installation du magasin est requis
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div style="float:right">
				<button :disabled="disabled" @click="suivant" class="btn btn-outline-primary btn-sm">
					valider
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import { validationMixin } from "vuelidate"
import { required } from "vuelidate/lib/validators"
import store from "../store"
export default {
	mixins: [validationMixin],
	data() {
		return {
			disabled: false,
			magasin: {
				nom: null,
				lieu: null,
			},
		}
	},
	validations: {
		magasin: {
			nom: {
				required,
			},
			lieu: {
				required,
			},
		},
	},
	methods: {
		suivant() {
			if (this.$v.$invalid) {
				this.$v.$touch()
			} else {
				store.state.magasin = JSON.parse(JSON.stringify(this.magasin))
				this.$emit("first-to-second")
			}
		},
		setLieu(value) {
			this.magasin.lieu = value
			this.$v.magasin.lieu.$touch()
		},
		setName(value) {
			this.magasin.nom = value
			this.$v.magasin.nom.$touch()
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
