<template>
	<div class="container">
		<div class="row">
			<div v-for="data in treeData" :key="data.id" class="col-md-4">
				<vue-tree-list
					@click="onClick"
					@change-name="onChangeName"
					@delete-node="onDel"
					@add-node="onAddNode"
					:model="data"
					default-tree-node-name="new node"
					default-leaf-node-name="nouveaux tiroir"
					v-bind:default-expanded="false"
				>
					<template v-slot:leafNameDisplay="slotProps">
						<span>
							{{ slotProps.model.name }}
						</span>
					</template>
					<span class="icon" slot="addTreeNodeIcon">📂</span>
					<span class="icon" slot="addLeafNodeIcon">＋</span>
					<span class="icon" slot="editNodeIcon">📃</span>
					<span class="icon" slot="delNodeIcon">✂️</span>
					<span class="icon" slot="leafNodeIcon">🍃</span>
					<span class="icon" slot="treeNodeIcon">🌲</span>
				</vue-tree-list>
			</div>
		</div>
		<b-modal @ok.prevent="makeTiroir" id="modal-tiroir" title="création de tiroir automatique">
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
					<input
						v-else
						class="form-control form-control-sm"
						type="number"
						min="1"
						v-model="longueur.colonne"
					/>
				</p>
			</div>
		</b-modal>
	</div>
</template>

<script>
import store from "./store"
import { VueTreeList, Tree } from "vue-tree-list"
import { BModal } from "bootstrap-vue"
export default {
	components: {
		VueTreeList,
		BModal,
	},
	mounted() {
		const etageres = store.state.etageres
		let pid = 0
		for (const key in etageres) {
			if (Object.hasOwnProperty.call(etageres, key)) {
				let children = []
				etageres[key].forEach(etagere => {
					const { identifiant, nom } = etagere
					children.push({
						name: "étagère " + nom,
						id: identifiant,
						pid: pid + 1,
						isLeaf: false,
						dragDisabled: true,
						addTreeNodeDisabled: true,
						addLeafNodeDisabled: false,
						editNodeDisabled: true,
						delNodeDisabled: true,
					})
				})
				const tree = new Tree([
					{
						name: "zone " + key,
						pid,
						dragDisabled: true,
						addTreeNodeDisabled: true,
						addLeafNodeDisabled: true,
						editNodeDisabled: true,
						delNodeDisabled: true,
						children,
					},
				])
				this.treeData.push(tree)
			}
			pid++
		}
	},
	data() {
		return {
			treeData: [],
			noeud: {},
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
		onDel(node) {
			console.log(node)
			node.remove()
		},

		onChangeName(params) {
			console.log(params)
		},

		onAddNode(params) {
			//params.name =
		},
		onClick(params) {
			const prefix = params.name.split(" ")[0]
			if (prefix === "étagère") {
				this.noeud = params
				this.$bvModal.show("modal-tiroir")
			}
		},
		makeTiroir() {
			const letters = "abcdefghijklmnopqrstuvwxyz"
			if (this.longueur.ligne === null && this.longueur.colonne === null) {
				this.notifier("le nombre de ligne et de colonne doit être renseigner", "OPERATION ECHOUEE", "danger")
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
				//création des tiroirs
				let tiroirs = []
				tabLigne.forEach(ligne => {
					tabColonne.forEach(colonne => {
						tiroirs.push({
							name: ligne + colonne,
							isLeaf: false,
							dragDisabled: true,
							addTreeNodeDisabled: true,
							addLeafNodeDisabled: true,
							editNodeDisabled: true,
							delNodeDisabled: true,
						})
					})
				})
				this.noeud.children = tiroirs
				console.log(this.noeud)
				this.$bvModal.hide("modal-tiroir")
			}
		},
	},
}
</script>

<style scoped></style>
