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
							<input @keyup="rechercher" type="text" v-model="search" class="form-control" />
							<span class="input-group-append">
								<button disabled type="button" class="btn btn-primary btn-flat">
									<i class="fas fa-search"></i>
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
				<!-- image standard du produit -->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<img width="200" :src="image.scategorie" />
						<center>
							<span class="text-dark">
								{{ image.nom.toUpperCase() }}
							</span>
						</center>
					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<form @submit="complete" enctype="multipart/form-data" class="col-md-10">
						<div class="form-group">
							<label for="reference">Réference <span class="requiredStar">*</span></label>
							<input
								v-model="piece.reference"
								name="reference"
								class="form-control form-control-sm"
								type="text"
								id="reference"
							/>
							<small>
								<span v-if="messages.reference.exist" class="text-danger">
									{{ messages.reference.value }}
								</span>
							</small>
						</div>
						<div class="form-group">
							<label>Etat de la piece<span class="requiredStar">*</span></label
							><br />
							<div class="form-check form-check-inline">
								<input
									v-model="piece.etat_piece"
									class="form-check-input"
									name="etat_piece"
									type="radio"
									id="e1"
									value="neuf"
								/>
								<label class="form-check-label" for="e1">Pièce Neuve</label>
							</div>
							<div class="form-check form-check-inline">
								<input
									v-model="piece.etat_piece"
									class="form-check-input"
									name="etat_piece"
									type="radio"
									id="e2"
									value="occasion"
								/>
								<label class="form-check-label" for="e2">Pièce d'occasion</label>
							</div>
							<small>
								<span v-if="messages.etat_piece.exist" class="text-danger">
									{{ messages.etat_piece.value }}
								</span>
							</small>
						</div>
						<div class="form-group">
							<label>Type de piece<span class="requiredStar">*</span></label
							><br />
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
							<small>
								<span v-if="messages.type_piece.exist" class="text-danger">
									{{ messages.type_piece.value }}
								</span>
							</small>
						</div>
						<div class="form-group">
							<label for="emplacement"
								>Emplacement dans le magasin<span class="requiredStar">*</span></label
							>
							<vue-select
								id="emplacement"
								v-model="piece.emplacement"
								:options="emplacements"
							></vue-select>
							<small>
								<span v-if="messages.emplacement.exist" class="text-danger">
									{{ messages.emplacement.value }}
								</span>
							</small>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea
								v-model="piece.description"
								class="form-control"
								id="description"
								cols="30"
								rows="4"
							></textarea>
						</div>
						<div class="form-group">
							<label for="fabricant">Image</label>
							<picture-input
								ref="pictureInput"
								:zIndex="0"
								@change="onChanged"
								@remove="onRemoved"
								:width="200"
								:removable="true"
								:hideChangeButton="true"
								:crop="true"
								removeButtonClass="btn btn-danger btn-sm"
								:height="200"
								accept="image/jpeg, image/png, image/gif"
								:customStrings="custom"
							>
							</picture-input>
						</div>
						<div class="form-group">
							<label for="fabricant">Fabricant</label>
							<vue-select v-model="piece.fabricant" :options="fabricants"></vue-select>
						</div>
						<h3>Véhicule</h3>
						<hr />
						<div v-if="!nouveau" class="row">
							<div class="col-md-9">
								<div class="form-group">
									<vue-select v-model="piece.oldcar" :options="vehiculesOptions"></vue-select>
								</div>
								<small>
									<span v-if="messages.vehicule.exist" class="text-danger">
										{{ messages.vehicule.value }}
									</span>
								</small>
							</div>
							<div class="col-md-3">
								<button @click="nouveau = true" class="btn btn-primary btn-sm">
									Nouveau véhicule
								</button>
							</div>
						</div>
						<b-modal
							@cancel="clearVehicule"
							@hide="clearVehicule"
							@ok.prevent="saveVehicule"
							v-model="nouveau"
							title="Création d'un nouveau véhicule"
							id="vehicule-modal"
						>
							<div class="form-group">
								<label for="marque">Marque<span class="requiredStar">*</span></label>
								<input
									class="form-control form-control-sm"
									v-model="vehicule.marque"
									type="text"
									id="marque"
								/>
								<small>
									<span v-if="messages.marque.exist" class="text-danger">
										{{ messages.marque.value }}
									</span>
								</small>
							</div>
							<div class="form-group">
								<label for="modele">Modèle<span class="requiredStar">*</span></label>
								<input
									class="form-control form-control-sm"
									v-model="vehicule.modele"
									type="text"
									id="modele"
								/>
								<small>
									<span v-if="messages.modele.exist" class="text-danger">
										{{ messages.modele.value }}
									</span>
								</small>
							</div>
							<div class="form-group">
								<label for="annee">Année<span class="requiredStar">*</span></label>
								<input
									class="form-control form-control-sm"
									v-model="vehicule.annee"
									type="text"
									id="annee"
								/>
								<small>
									<span v-if="messages.annee.exist" class="text-danger">
										{{ messages.annee.value }}
									</span>
								</small>
							</div>
							<div class="form-group">
								<label for="carburant">Energie<span class="requiredStar">*</span></label
								><br />
								<div class="form-check form-check-inline">
									<input
										v-model="vehicule.carburant"
										class="form-check-input"
										name="carburant"
										type="radio"
										id="C1"
										value="diesel"
									/>
									<label class="form-check-label" for="C1">Diesiel</label>
								</div>
								<div class="form-check form-check-inline">
									<input
										v-model="vehicule.carburant"
										class="form-check-input"
										name="carburant"
										type="radio"
										id="C2"
										value="gasoil"
									/>
									<label class="form-check-label" for="C2">Gasoil</label>
								</div>
								<div class="form-check form-check-inline">
									<input
										v-model="piece.carburant"
										class="form-check-input"
										name="carburant"
										type="radio"
										id="C3"
										value="electrique"
									/>
									<label class="form-check-label" for="C3">Electrique</label>
								</div>
								<small>
									<span v-if="messages.carburant.exist" class="text-danger">
										{{ messages.carburant.value }}
									</span>
								</small>
							</div>
							<div class="form-group">
								<label for="vitesse">Boîte des vitesse<span class="requiredStar">*</span></label
								><br />
								<div class="form-check form-check-inline">
									<input
										v-model="vehicule.vitesse"
										class="form-check-input"
										name="vitesse"
										type="radio"
										id="B1"
										value="automatique"
									/>
									<label class="form-check-label" for="B1">Boîte automatique</label>
								</div>
								<div class="form-check form-check-inline">
									<input
										v-model="vehicule.vitesse"
										class="form-check-input"
										name="vitesse"
										type="radio"
										id="B2"
										value="manuel"
									/>
									<label class="form-check-label" for="B2">Boîte manuelle</label>
								</div>
								<small>
									<span v-if="messages.vitesse.exist" class="text-danger">
										{{ messages.vitesse.value }}
									</span>
								</small>
							</div>
						</b-modal>
					</form>
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
import { BModal } from "bootstrap-vue"
import { FormWizard, TabContent, ValidationHelper } from "vue-step-wizard"
import { required } from "vuelidate/lib/validators"
import PictureInput from "vue-picture-input"
//step content
let sous_categories_initial = []
let sous_categorie_concern = []
let currentStep = 1
export default {
	props: {
		fabricants: Array,
		vehicules: Array,
		emplacements: Array,
	},
	mixins: [ValidationHelper],
	components: {
		FormWizard,
		TabContent,
		VueSelect,
		vueCustomScrollbar,
		PictureInput,
		BModal,
	},
	data() {
		return {
			search: "",
			selected: false,
			nouveau: false,
			vehiculesOptions: [],
			categories: [],
			formData: {
				categorie: null,
				scategorie: null,
			},
			scategories: [],
			vehicule: {
				marque: "",
				modele: "",
				annee: "",
				vitesse: "",
				carburant: "",
			},
			piece: {
				reference: "",
				image: "",
				description: "",
				type_piece: "",
				etat_piece: "",
				emplacement: "",
				fabricant: "",
				oldcar: "",
			},
			image: {
				scategorie: null,
				nom: "",
			},
			messages: {
				reference: {
					exist: false,
					value: null,
				},
				type_piece: {
					exist: false,
					value: null,
				},
				etat_piece: {
					exist: false,
					value: null,
				},
				image: {
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
				vitesse: {
					exist: false,
					value: null,
				},
				carburant: {
					exist: false,
					value: null,
				},
				emplacement: {
					exist: false,
					value: null,
				},
			},
			options: {
				suppressScrollY: false,
				suppressScrollX: true,
				wheelPropagation: false,
			},
			validationRules: [{ categorie: { required } }, { scategorie: { required } }],
			custom: {
				drag: "Glisser, déposer une image ou <br><b>cliquer ici pour selectioner une image</b>", // HTML allowed
				change: "Changer image", // Text only
				remove: "Supprimer image", // Text only
				select: "Select a Photo", // Text only
				selected: "<p>Image selectionée avec succès</p>", // HTML allowed
				fileSize: "Ce fichier est trop grand", // Text only
				fileType: "Fichiers supportés (jpg,jpeg,gif)", // Text only
			},
		}
	},
	mounted() {
		this.getCategories()
		this.getScategories()
		this.vehiculesOptions = this.vehicules
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
					sous_categories_initial = scategories.map(scategorie => {
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
				.get("/systeme/async/scategories/from/" + this.formData.categorie)
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
		clearVehicule() {
			this.messages.marque = {
				exist: false,
				value: null,
			}
			this.messages.modele = {
				exist: false,
				value: null,
			}
			this.messages.annee = {
				exist: false,
				value: null,
			}
			this.messages.vitesse = {
				exist: false,
				value: null,
			}
			this.messages.carburant = {
				exist: false,
				value: null,
			}
		},
		refreshVehicules() {
			axios
				.get("/systeme/async/vehicules")
				.then(result => {
					this.vehiculesOptions = result.data.vehicules
				})
				.catch(err => {})
		},
		saveVehicule() {
			this.clearVehicule()
			const postObject = {
				marque: this.vehicule.marque,
				annee: this.vehicule.annee,
				modele: this.vehicule.modele,
				carburant: this.vehicule.carburant,
				boite: this.vehicule.vitesse,
			}
			this.axios
				.post("/stock/vehicule/store", { ...postObject })
				.then(result => {
					this.notifier(result.data.message, "OPERATION REUSSIE", "success")
					this.refreshVehicules()
					//fermer le modal
					this.$nextTick(() => {
						this.$bvModal.hide("vehicule-modal")
					})
				})
				.catch(err => {
					const { errors } = err.response.data
					if (errors) {
						this.errorVehiculeWriting(errors)
					}
				})
		},
		nextStep() {
			console.log(this.$v.$invalid)
		},
		complete() {
			let formData = new FormData()
			formData.append("image", this.piece.image)
			formData.append("categorie", this.formData.categorie)
			formData.append("reference", this.piece.reference)
			formData.append("emplacement", this.piece.emplacement ? this.piece.emplacement.code : "")
			formData.append("description", this.piece.description)
			formData.append("sous_categorie", this.formData.scategorie)
			formData.append("description", this.piece.description)
			formData.append("etat_piece", this.piece.etat_piece)
			formData.append("type_piece", this.piece.type_piece)
			formData.append("fabricant", this.piece.fabricant ? this.piece.fabricant.code : "")
			formData.append("vehicule", this.piece.oldcar ? this.piece.oldcar.code : "")
			axios
				.post("/stock/piece/store", formData, {
					headers: {
						"content-type": "multipart/form-data",
					},
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
					if (errors) {
						this.errorWriting(errors)
					}
				})
		},
		errorWriting(errors) {
			if (errors.reference) {
				this.messages.reference.exist = true
				this.messages.reference.value = errors.reference[0]
			}
			if (errors.etat_piece) {
				this.messages.etat_piece.exist = true
				this.messages.etat_piece.value = errors.etat_piece[0]
			}
			if (errors.type_piece) {
				this.messages.type_piece.exist = true
				this.messages.type_piece.value = errors.type_piece[0]
			}
			if (errors.image) {
				this.messages.image.exist = true
				this.messages.image.value = errors.image[0]
			}
			if (errors.vehicule) {
				this.messages.vehicule.exist = true
				this.messages.vehicule.value = errors.vehicule[0]
			}
			if (errors.emplacement) {
				this.messages.emplacement.exist = true
				this.messages.emplacement.value = errors.emplacement[0]
			}
			if (errors.vehicule) {
				this.messages.vehicule.exist = true
				this.messages.vehicule.value = "le véhicule est requis."
			}
		},
		errorVehiculeWriting(errors) {
			if (errors.marque) {
				this.messages.marque.exist = true
				this.messages.marque.value = errors.marque[0]
			}
			if (errors.modele) {
				this.messages.modele.exist = true
				this.messages.modele.value = errors.modele[0]
			}
			if (errors.annee) {
				this.messages.annee.exist = true
				this.messages.annee.value = errors.annee[0]
			}
			if (errors.carburant) {
				this.messages.carburant.exist = true
				this.messages.carburant.value = errors.carburant[0]
			}
			if (errors.boite_vitesse) {
				this.messages.vitesse.exist = true
				this.messages.vitesse.value = errors.boite_vitesse[0]
			}
		},
		previousStep() {
			currentStep--
			this.getCategories()
			this.search = null
			if (this.formData.scategorie) {
				this.getScategoriesFrom()
				this.formData.scategorie = null
			}
		},
		rechercher() {
			if (this.search) {
				const found = sous_categorie_concern.filter(item => {
					return this.search
						.toLowerCase()
						.split(" ")
						.every(v => item.nom.toLowerCase().includes(v))
				})
				if (found.length > 0) {
					this.scategories = found
				} else {
					this.scategories = sous_categorie_concern
				}
			}
		},
		selectCategorie(id) {
			console.log("selectCategorie", id)
			this.formData.categorie = id
			this.categories.forEach(categorie => {
				if (categorie.id === id) {
					categorie.selected = true
				} else {
					categorie.selected = false
				}
			})
			//filter les sous-categorie pour prendre celle qui correspondent
			sous_categorie_concern = sous_categories_initial.filter(scategorie => scategorie.categorie === id)
			this.scategories = sous_categorie_concern
		},
		selectScategorie(id) {
			console.log("selectScategorie", id)
			this.formData.scategorie = id
			this.scategories.forEach(scategorie => {
				if (scategorie.id === id) {
					scategorie.selected = true
					this.image.scategorie = scategorie.image
					this.image.nom = scategorie.nom
				} else {
					scategorie.selected = false
				}
			})
		},
		onChanged() {
			if (this.$refs.pictureInput.file) {
				this.piece.image = this.$refs.pictureInput.file
			} else {
				console.log("Old browser. No support for Filereader API")
			}
		},
		onRemoved() {
			this.piece.image = ""
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
.requiredStar {
	color: red;
	position: relative;
	top: -0.1rem;
	right: 0rem;
	font-size: 1.4em;
}
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
