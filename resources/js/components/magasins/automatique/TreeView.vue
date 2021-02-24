<template>
	<div class="container">
		<div class="row">
			<div v-for="data in treeData" class="col-md-4">
				<vue-custom-scrollbar class="scrollarea">
					<vue-tree-list
						@click="onClick"
						@change-name="onChangeName"
						@delete-node="onDel"
						@add-node="onAddNode"
						:model="data"
						default-tree-node-name="new node"
						default-leaf-node-name="nouveaux tiroir"
						v-bind:default-expanded="true"
					>
						<template v-slot:leafNameDisplay="slotProps">
							<span>
								{{ slotProps.model.name }}
							</span>
						</template>
					</vue-tree-list>
				</vue-custom-scrollbar>
			</div>
		</div>
		<modal-tiroir @tiroirs="onAddTiroir" :identifiant="sendId" />
	</div>
</template>

<script>
import store from "../store"
import { VueTreeList, Tree } from "vue-tree-list"
import ModalTiroir from "./ModalTiroir"
import vueCustomScrollbar from "vue-custom-scrollbar"
import "vue-custom-scrollbar/dist/vueScrollbar.css"
export default {
	components: {
		VueTreeList,
		ModalTiroir,
		vueCustomScrollbar,
	},
	mounted() {
		const etageres = store.state.etageres
		if (etageres.constructor.name === "Object") {
			for (const key in etageres) {
				if (Object.hasOwnProperty.call(etageres, key)) {
					let children = []
					etageres[key].forEach(etagere => {
						const { identifiant, nom } = etagere
						children.push({
							name: "étagère " + nom,
							id: identifiant,
							isLeaf: false,
							dragDisabled: true,
							addTreeNodeDisabled: true,
							addLeafNodeDisabled: !store.state.manuel,
							editNodeDisabled: true,
							delNodeDisabled: true,
							children: [],
						})
					})
					const tree = new Tree([
						{
							name: "zone " + key,
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
			}
		} else {
			etageres.forEach(etagere => {
				const { nom, identifiant } = etagere
				const tree = new Tree([
					{
						name: "étagère " + nom,
						id: identifiant,
						dragDisabled: true,
						addTreeNodeDisabled: true,
						addLeafNodeDisabled: !store.state.manuel,
						editNodeDisabled: true,
						delNodeDisabled: true,
					},
				])
				this.treeData.push(tree)
			})
		}
	},
	data() {
		return {
			treeData: [],
			noeud: {},
			sendId: "",
			compteur: 1,
		}
	},
	methods: {
		onDel(node) {
			//console.log(node)
			node.remove()
			// delete store.state.tiroirs[node.pid]
		},
		onChangeName(params) {
			// let calebasse = {}
			// if (Object.keys(store.state.tiroirs).length > 0) {
			// 	calebasse = store.state.tiroirs
			// 	for (const key in calebasse) {
			// 		if (Object.hasOwnProperty.call(calebasse, key)) {
			// 			let found = calebasse[key].find(element => element.id == params.id)
			// 			console.log(found)
			// 		}
			// 	}
			// }
			// console.log(store.state.tiroirs)
		},
		onAddNode(params) {
			//console.log(params)
			// let tiroirData = {
			// 	name: "Tiroir " + this.compteur,
			// 	isLeaf: true,
			// 	dragDisabled: true,
			// 	addTreeNodeDisabled: true,
			// 	addLeafNodeDisabled: true,
			// 	editNodeDisabled: true,
			// 	delNodeDisabled: true,
			// }
			// let calebasse = {}
			// if (Object.keys(store.state.tiroirs).length > 0) {
			// 	calebasse = store.state.tiroirs
			// 	for (const key in calebasse) {
			// 		if (Object.hasOwnProperty.call(calebasse, key)) {
			// 			if (params.pid == key) {
			// 				calebasse[key] = tiroirData
			// 			} else {
			// 				this.compteur++
			// 				const marmite = calebasse
			// 				store.state.tiroirs = { ...marmite, [params.pid]: tiroirData }
			// 			}
			// 		}
			// 	}
			// } else {
			// 	store.state.tiroirs = { [params.pid]: tiroirData }
			// }
			// console.log(store.state.tiroirs)
		},
		onClick(params) {
			// console.log(params)
			const prefix = params.name.split(" ")[0]
			if (prefix === "étagère" && !store.state.manuel) {
				this.noeud = params
				this.sendId = this.noeud.id
				this.$bvModal.show("modal-tiroir")
			}
		},
		onAddTiroir(tiroirs) {
			this.treeData = []
			const etageres = store.state.etageres
			if (etageres.constructor.name === "Object") {
				for (const key in etageres) {
					if (Object.hasOwnProperty.call(etageres, key)) {
						let children = []
						etageres[key].forEach(etagere => {
							const { identifiant, nom } = etagere
							let tiroirData = []
							let calebasse = {}
							//prise en charge des autres tiroirs existant
							if (Object.keys(store.state.tiroirs).length > 0) {
								calebasse = store.state.tiroirs
								for (const key in calebasse) {
									if (Object.hasOwnProperty.call(calebasse, key)) {
										if (identifiant == key) {
											tiroirData = calebasse[key]
										}
									}
								}
							} else {
								tiroirData = tiroirs
							}
							children.push({
								name: "étagère " + nom,
								id: identifiant,
								isLeaf: false,
								dragDisabled: true,
								addTreeNodeDisabled: true,
								addLeafNodeDisabled: !store.state.manuel,
								editNodeDisabled: true,
								delNodeDisabled: true,
								children: tiroirData,
							})
						})
						const tree = new Tree([
							{
								name: "zone " + key,
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
				}
			} else {
				etageres.forEach(etagere => {
					const { nom, identifiant } = etagere
					let tiroirData = []
					let calebasse = {}
					//prise en charge des autres tiroirs existant
					if (Object.keys(store.state.tiroirs).length > 0) {
						calebasse = store.state.tiroirs
						for (const key in calebasse) {
							if (Object.hasOwnProperty.call(calebasse, key)) {
								if (identifiant == key) {
									tiroirData = calebasse[key]
								}
							}
						}
					} else {
						tiroirData = tiroirs
					}
					const tree = new Tree([
						{
							name: "étagère " + nom,
							id: identifiant,
							dragDisabled: true,
							addTreeNodeDisabled: true,
							addLeafNodeDisabled: !store.state.manuel,
							editNodeDisabled: true,
							delNodeDisabled: true,
							children: tiroirData,
						},
					])
					this.treeData.push(tree)
				})
			}
		},
	},
}
</script>

<style scoped>
.scrollarea {
	height: 15.8em;
}
</style>
