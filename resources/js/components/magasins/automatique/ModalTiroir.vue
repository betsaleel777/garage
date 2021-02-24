<template>
	<b-modal @ok="makeTiroir" id="modal-tiroir" title="création de tiroir automatique">
		<b>Ligne</b>
		<div class="container">
			<div class="form-check">
				<input
					value="alpha"
					class="form-check-input"
					v-model="type.ligne"
					type="radio"
					name="type_ligne"
					id="radio1"
				/>
				<label class="form-check-label" for="radio1">
					Alphabétique
				</label>
			</div>
			<div class="form-check">
				<input
					value="num"
					class="form-check-input"
					v-model="type.ligne"
					type="radio"
					name="type_ligne"
					id="radio2"
				/>
				<label class="form-check-label" for="radio2">
					Numérique
				</label>
			</div>
			<p v-if="type.ligne !== null">
				<input
					v-if="type.ligne === 'alpha'"
					class="form-control form-control-sm"
					type="number"
					min="1"
					max="26"
					v-model="longueur.ligne"
				/>
				<input v-else class="form-control form-control-sm" type="number" min="1" v-model="longueur.ligne" />
			</p>
		</div>
		<b>Colonne</b>
		<div class="container">
			<div class="form-check">
				<input
					value="alpha"
					class="form-check-input"
					v-model="type.colonne"
					type="radio"
					name="type_colonne"
					id="radio3"
				/>
				<label class="form-check-label" for="radio3">
					Alphabétique
				</label>
			</div>
			<div class="form-check">
				<input
					value="num"
					class="form-check-input"
					v-model="type.colonne"
					type="radio"
					name="type_colonne"
					id="radio4"
				/>
				<label class="form-check-label" for="radio4">
					Numérique
				</label>
			</div>
			<p v-if="type.colonne !== null">
				<input
					v-if="type.colonne === 'alpha'"
					class="form-control form-control-sm"
					type="number"
					min="1"
					max="26"
					v-model="longueur.colonne"
				/>
				<input v-else class="form-control form-control-sm" type="number" min="1" v-model="longueur.colonne" />
			</p>
		</div>
	</b-modal>
</template>

<script>
import store from "../store"
import { BModal } from "bootstrap-vue"
export default {
	props: {
		//l'identifiant de l'etagère
		identifiant: String,
	},
	components: {
		BModal,
	},
	data() {
		return {
			type: {
				ligne: null,
				colonne: null,
			},
			longueur: {
				ligne: null,
				colonne: null,
			},
		}
	},
	methods: {
		makeTiroir() {
			const letters = "abcdefghijklmnopqrstuvwxyz"
			if (!Boolean(this.longueur.ligne) || !Boolean(this.longueur.colonne)) {
				this.notifier("le nombre de ligne et de colonne doit être renseigner", "OPERATION ECHOUEE", "danger")
				this.viderModal()
			} else {
				//initialisation des données
				let tabLigne = []
				let tabColonne = []
				if (this.type.ligne === "alpha") {
					const calebasse = letters.substring(0, this.longueur.ligne)
					for (let index = 0; index < calebasse.length; index++) {
						tabLigne.push(calebasse.charAt(index).toUpperCase())
					}
				} else {
					for (let compteur = 1; compteur <= this.longueur.ligne; compteur++) {
						tabLigne.push(compteur)
					}
				}
				if (this.type.colonne === "alpha") {
					const calebasse = letters.substring(0, this.longueur.colonne)
					for (let index = 0; index < calebasse.length; index++) {
						tabColonne.push(calebasse.charAt(index).toUpperCase())
					}
				} else {
					for (let compteur = 1; compteur <= this.longueur.colonne; compteur++) {
						tabColonne.push(compteur)
					}
				}
				//création des tiroirs pour la treeView et pour le store
				let tiroirs = []
				let tiroirStore = []
				let compteurX = 0
				let compteurY = 0
				tabLigne.forEach(ligne => {
					tabColonne.forEach(colonne => {
						compteurY++
						//pour la treeView
						tiroirs.push({
							name: "Tiroir " + ligne + "." + colonne,
							id: compteurX + compteurY,
							isLeaf: true,
							dragDisabled: true,
							addTreeNodeDisabled: true,
							addLeafNodeDisabled: true,
							editNodeDisabled: true,
							delNodeDisabled: true,
						})
						//pour le store
						tiroirStore.push({
							name: "Tiroir " + ligne + "." + colonne,
							id: compteurX + compteurY,
							isLeaf: true,
							dragDisabled: true,
							addTreeNodeDisabled: true,
							addLeafNodeDisabled: true,
							editNodeDisabled: true,
							delNodeDisabled: true,
						})
					})
					compteurX++
				})
				let calebasse = null
				if (Object.keys(store.state.tiroirs).length > 0) {
					calebasse = store.state.tiroirs
					for (const key in calebasse) {
						if (Object.hasOwnProperty.call(calebasse, key)) {
							if (this.identifiant == key) {
								calebasse[key] = tiroirStore
								store.state.tiroirs = calebasse
							} else {
								const marmite = calebasse
								store.state.tiroirs = { ...marmite, [this.identifiant]: tiroirStore }
							}
						}
					}
				} else {
					store.state.tiroirs = { [this.identifiant]: tiroirStore }
				}
				this.viderModal()
				this.$emit("tiroirs", tiroirs)
			}
		},
		notifier(message, titre, variant) {
			this.$bvToast.toast(message, {
				title: titre,
				solid: true,
				variant: variant,
			})
		},
		viderModal() {
			this.type = {
				ligne: null,
				colonne: null,
			}
			this.longueur = {
				ligne: null,
				colonne: null,
			}
		},
	},
}
</script>

<style></style>
