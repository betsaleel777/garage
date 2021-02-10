<template>
	<form-wizard @onNextStep="nextStep" @onPreviousStep="previousStep" @onComplete="complete">
		<tab-content title="Compartiments" :selected="true">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="row">
							<div v-for="categorie in categories" :key="categorie.id" class="col-md-3">
								<figure @click="selectCategorie(categorie.id)" class="figure">
									<img
										class="figure-img img-fluid rounded image"
										width="100"
										:src="categorie.image"
										:alt="categorie.nom"
										:id="categorie.id"
									/>
									<span v-if="categorie.selected" class="text-primary selected"
										><i class="fas fa-lg fa-check-circle"></i
									></span>
									<figcaption class="figure-caption text-center">
										{{ categorie.nom }}
									</figcaption>
								</figure>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</tab-content>
		<tab-content title="Sous-compartiments">
			<div class="container">
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="input-group input-group-sm">
							<input type="text" v-model="search" class="form-control" />
							<span class="input-group-append">
								<button @click="rechercher" type="button" class="btn btn-primary btn-flat">
									ok
								</button>
							</span>
						</div>
					</div>
				</div>
				<!-- utiliser scroll ici -->
				<vue-custom-scrollbar class="scrollarea" :settings="options">
					<div class="row">
						<div class="col-md-1"></div>
						<div style="margin-top:10px" class="row col-md-10">
							<div v-for="scategorie in scategories" :key="scategorie.id" class="col-md-3">
								<figure @click="selectScategorie(scategorie.id)" class="figure">
									<img
										class="figure-img img-fluid rounded image"
										width="100"
										:src="scategorie.image"
										:alt="scategorie.nom"
										:id="scategorie.id"
									/>
									<span v-if="scategorie.selected" class="text-primary selected"
										><i class="fas fa-lg fa-check-circle"></i
									></span>
									<figcaption class="figure-caption text-center">
										{{ scategorie.nom }}
									</figcaption>
								</figure>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</vue-custom-scrollbar>
			</div>
		</tab-content>
		<tab-content title="Pieces">
			<div class="container">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<img width="200" :src="image.scategorie" />
					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="form-group">
							<label for="achat">Prix d'achat</label>
							<input v-model="piece.achat" class="form-control" type="text" id="achat" />
							<span v-if="messages.prix_achat.exist" class="text-danger">
								{{ messages.prix_achat.value }}
							</span>
						</div>
						<div class="form-group">
							<label for="vente">Prix de vente</label>
							<input v-model="piece.vente" class="form-control" type="text" id="vente" />
							<span v-if="messages.prix_vente.exist" class="text-danger">
								{{ messages.prix_vente.value }}
							</span>
						</div>
						<div class="form-group">
							<label for="vente">Type de piece</label><br />
							<div class="form-check form-check-inline">
								<input
									v-model="piece.type_piece"
									class="form-check-input"
									name="type_piece"
									type="radio"
									id="t1"
									value="adaptable"
								/>
								<label class="form-check-label" for="t1">Pièce adaptable</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									v-model="piece.type_piece"
									class="form-check-input"
									name="type_piece"
									type="radio"
									id="t2"
									value="origine"
								/>
								<label class="form-check-label" for="t2">Pièce d'origine</label>
							</div>
							<span v-if="messages.type_piece.exist" class="text-danger">
								{{ messages.type_piece.value }}
							</span>
						</div>
						<div class="form-group">
							<label for="emplacement">Emplacement en magasin</label>
							<input v-model="piece.emplacement" class="form-control" type="text" id="emplacement" />
						</div>
						<div class="form-group">
							<label for="magasin">Magasin de stockage</label>
							<vue-select v-model="piece.magasin" :options="magasins"></vue-select>
						</div>
						<h3>Véhicule</h3>
						<hr />
						<div v-if="!nouveau" class="row">
							<div class="col-md-6">
								<div class="form-group">
									<vue-select v-model="piece.oldcar" :options="vehicules"></vue-select>
								</div>
								<span v-if="messages.vehicule.exist" class="text-danger">
									{{ messages.vehicule.value }}
								</span>
							</div>
							<div class="col-md-4">
								<button @click="nouveau = true" class="btn btn-primary">
									Nouveau véhicule
								</button>
							</div>
						</div>
						<div v-if="nouveau" class="row form-group">
							<div class="col-3">
								<label for="marque">Marque</label>
								<input class="form-control" v-model="piece.marque" type="text" id="marque" />
								<small>
									<span v-if="messages.marque.exist" class="text-danger">
										{{ messages.marque.value }}
									</span>
								</small>
							</div>
							<div class="col-3">
								<label for="modele">Modèle</label>
								<input class="form-control" v-model="piece.modele" type="text" id="modele" />
								<small>
									<span v-if="messages.modele.exist" class="text-danger">
										{{ messages.modele.value }}
									</span>
								</small>
							</div>
							<div class="col-2">
								<label for="annee">Année</label>
								<input class="form-control" v-model="piece.annee" type="text" id="annee" />
								<small>
									<span v-if="messages.annee.exist" class="text-danger">
										{{ messages.annee.value }}
									</span>
								</small>
							</div>
							<div class="col-4">
								<label for="type_vehicule">Type</label>
								<vue-select
									id="type_vehicule"
									:options="types_vehicule"
									v-model="piece.type_vehicule"
								></vue-select>
								<small>
									<span v-if="messages.type_vehicule.exist" class="text-danger">
										{{ messages.type_vehicule.value }}
									</span>
								</small>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</tab-content>
	</form-wizard>
</template>

<script>
//local registration
import vueCustomScrollbar from "vue-custom-scrollbar"
import "vue-custom-scrollbar/dist/vueScrollbar.css"
import VueSelect from "vue-select"
import { FormWizard, TabContent } from "vue-step-wizard"
//step content

export default {
	props: {
		magasins: Array,
		vehicules: Array,
	},
	components: {
		FormWizard,
		TabContent,
		VueSelect,
		vueCustomScrollbar,
	},
	data() {
		return {
			search: "",
			selected: false,
			nouveau: false,
			categories: [],
			categorie: null,
			scategories: [],
			scategorie: null,
			piece: {
				achat: null,
				vente: null,
				type_piece: null,
				emplacement: null,
				magasin: null,
				oldcar: null,
				marque: null,
				modele: null,
				annee: null,
				type_vehicule: null,
			},
			types_vehicule: [
				"citadine",
				"berline break",
				"berline familliale",
				"berline grande routière",
				"berline limousine",
				"SUV urbains",
				"SUV familiaux",
				"SUV 4x4",
				"monospace",
				"ludospace",
				"coupé",
				"cabriolet",
				"utilitaire",
				"utilitaire léger",
				"camion",
			],
			image: {
				scategorie: null,
			},
			messages: {
				prix_achat: {
					exist: false,
					value: null,
				},
				prix_vente: {
					exist: false,
					value: null,
				},
				type_piece: {
					exist: false,
					value: null,
				},
				vehicule: {
					exist: false,
					value: null,
				},
				marque: {
					exist: false,
					value: null,
				},
				modele: {
					exist: false,
					value: null,
				},
				annee: {
					exist: false,
					value: null,
				},
				type_vehicule: {
					exist: false,
					value: null,
				},
			},
			options: {
				suppressScrollY: false,
				suppressScrollX: true,
				wheelPropagation: false,
			},
		}
	},
	mounted() {
		this.getCategories()
		this.getScategories()
	},
	methods: {
		getCategories() {
			axios
				.get("/systeme/async/categories")
				.then(result => {
					const { categories } = result.data
					this.categories = categories.map(categorie => {
						return {
							id: categorie.id,
							nom: categorie.nom,
							image: "/storage/" + categorie.image,
							selected: false,
						}
					})
				})
				.catch(err => {})
		},
		getScategories() {
			axios
				.get("/systeme/async/scategories")
				.then(result => {
					const { scategories } = result.data
					this.scategories = scategories.map(scategorie => {
						return {
							id: scategorie.id,
							nom: scategorie.nom,
							image: "/storage/" + scategorie.image,
							categorie: scategorie.categorie,
							selected: false,
						}
					})
				})
				.catch(err => {})
		},
		getScategoriesFrom() {
			axios
				.get("/systeme/async/scategories/from/" + this.categorie)
				.then(result => {
					const { scategories } = result.data
					this.scategories = scategories.map(scategorie => {
						return {
							id: scategorie.id,
							nom: scategorie.nom,
							image: "/storage/" + scategorie.image,
							categorie: scategorie.categorie,
							selected: false,
						}
					})
				})
				.catch(err => {})
		},
		nextStep() {},
		complete() {
			axios
				.post("/stock/piece/store", {
					categorie: this.categorie,
					magasin: this.piece.magasin ? this.piece.magasin.code : null,
					sous_categorie: this.scategorie,
					prix_achat: this.piece.achat,
					prix_vente: this.piece.vente,
					emplacement: this.piece.emplacement,
					type_piece: this.piece.type_piece,
					vehicule: this.piece.oldcar ? this.piece.oldcar.code : null,
					marque: this.piece.marque,
					modele: this.piece.modele,
					annee: this.piece.annee,
					type_vehicule: this.piece.type_vehicule,
				})
				.then(result => {
					this.$bvModal
						.msgBoxConfirm("Voulez vous créer une autre pièce de vehicule ?", {
							title: "Créer à nouveau",
							size: "md",
							buttonSize: "sm",
							okVariant: "danger",
							okTitle: "Confirmer",
							cancelTitle: "Annuler",
							footerClass: "p-2",
							hideHeaderClose: false,
							centered: true,
						})
						.then(value => {
							value ? location.reload() : (location.href = "/stock/piece/liste")
						})
						.catch(err => {})
				})
				.catch(err => {
					const { errors } = err.response.data
					if (errors.prix_achat) {
						this.messages.prix_achat.exist = true
						this.messages.prix_achat.value = errors.prix_achat[0]
					}
					if (errors.prix_vente) {
						this.messages.prix_vente.exist = true
						this.messages.prix_vente.value = errors.prix_vente[0]
					}
					if (errors.type_piece) {
						this.messages.type_piece.exist = true
						this.messages.type_piece.value = errors.type_piece[0]
					}
					if (errors.vehicule) {
						this.messages.vehicule.exist = true
						this.messages.vehicule.value = errors.vehicule[0]
					}
					if (errors.marque) {
						this.messages.marque.exist = true
						this.messages.marque.value = errors.marque[0]
					}
					if (errors.modele) {
						this.messages.modele.exist = true
						this.messages.modele.value = errors.modele[0]
					}
					if (errors.type_vehicule) {
						this.messages.type_vehicule.exist = true
						this.messages.type_vehicule.value = errors.type_vehicule[0]
					}
					if (errors.annee) {
						this.messages.annee.exist = true
						this.messages.annee.value = errors.annee[0]
					}
					if (errors.marque || errors.modele || errors.annee || errors.type_vehicule) {
						if (!this.nouveau) {
							this.messages.vehicule.exist = true
							this.messages.vehicule.value = "le véhicule est requis."
						}
					}
				})
		},
		previousStep() {
			this.getCategories()
			if (this.scategorie) {
				this.getScategoriesFrom()
				this.scategorie = null
			} else {
				this.getScategories()
			}
			this.search = null
		},
		rechercher() {
			if (this.search) {
				const found = this.scategories.filter(item => {
					return this.search
						.toLowerCase()
						.split(" ")
						.every(v => item.nom.toLowerCase().includes(v))
				})
				if (found.length > 0) {
					this.scategories = found
				} else {
					const message = "Aucun resultat trouvé pour la recherche."
					this.notifier(message, "BON A SAVOIR", "info")
				}
			}
		},
		selectCategorie(id) {
			this.categorie = id
			this.categories.forEach(categorie => {
				if (categorie.id === id) {
					categorie.selected = true
				} else {
					categorie.selected = false
				}
			})
			//filter les sous-categorie pour prendre celle qui correspondent
			this.scategories = this.scategories.filter(scategorie => scategorie.categorie === id)
		},
		selectScategorie(id) {
			this.scategorie = id
			this.scategories.forEach(scategorie => {
				if (scategorie.id === id) {
					scategorie.selected = true
					this.image.scategorie = scategorie.image
				} else {
					scategorie.selected = false
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

<style scoped>
.scrollarea {
	height: 500px;
	margin-top: 3%;
}
.image {
	background-color: white;
	border: 1px solid black;
	padding: 4px;
	transition: 0.3s;
}
.image:hover {
	background-color: black;
	opacity: 0.8;
	color: white;
}
.selected {
	position: relative;
	background-color: white;
	top: -50px;
	right: 16px;
}
.figure-caption {
	font-size: 12px;
}
label {
	font-size: 13px;
}
</style>
