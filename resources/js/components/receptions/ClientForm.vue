<template>
    <div>
        <div class="row">
            <div v-if="!nouveau_client" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <label for="contact">Recherche client</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group input-group">
                            <input
                                type="text"
                                v-model="contact"
                                class="form-control"
                                id="contact"
                                placeholder="renseignez le contact du client"
                            />
                            <span class="input-group-append">
                                <button
                                    @click="rechercher"
                                    type="button"
                                    class="btn btn-primary btn-flat"
                                >
                                    rechercher
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!nouveau_client" class="col-md-6">
                <button
                    type="button"
                    @click="nouveau_client = true"
                    class="btn btn-primary"
                >
                    Nouveau client
                </button>
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
                                    type="radio"
                                    @change="cocher"
                                    name="kind"
                                    id="inlineradio1"
                                    value="particulier"
                                    v-model="kind"
                                />
                                <label
                                    class="form-check-label"
                                    for="inlineradio1"
                                    >Particulier</label
                                >
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    @change="cocher"
                                    name="kind"
                                    id="inlineradio2"
                                    value="entreprise"
                                    v-model="kind"
                                />
                                <label
                                    class="form-check-label"
                                    for="inlineradio2"
                                    >Entreprise</label
                                >
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    @change="cocher"
                                    name="kind"
                                    id="inlineradio3"
                                    value="assurance"
                                    v-model="kind"
                                />
                                <label
                                    class="form-check-label"
                                    for="inlineradio3"
                                    >Assurance</label
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button
                            @click="etat_initial"
                            type="button"
                            class="btn btn-danger btn-sm ui-button"
                        >
                            retour
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="particulier" class="row">
            <div class="form-group col-md-4">
                <label for="nom">Nom complet</label>
                <input
                    name="nom_complet"
                    v-model="nom_complet"
                    class="form-control"
                    id="nom"
                />
                <span v-if="messages.nom_complet.exist" class="text-danger">{{
                    messages.nom_complet.value
                }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="telephone">Téléphone</label>
                <input
                    name="telephone"
                    v-model="telephone"
                    class="form-control"
                    id="telephone"
                />
                <span v-if="messages.telephone.exist" class="text-danger">{{
                    messages.telephone.value
                }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input
                    name="email"
                    type="email"
                    v-model="email"
                    class="form-control"
                    id="email"
                />
                <span v-if="messages.email.exist" class="text-danger">{{
                    messages.email.value
                }}</span>
            </div>
        </div>
        <div v-if="assurance" class="row">
            <div class="form-group col-md-6">
                <label for="nom_assurance">Nom de l'assurance</label>
                <input
                    name="nom_assurance"
                    v-model="nom_assurance"
                    class="form-control"
                    id="nom_assurance"
                />
                <span v-if="messages.nom_assurance.exist" class="text-danger">{{
                    messages.nom_assurance.value
                }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="representant_assurance"
                    >Nom du représentant de l'assurance</label
                >
                <input
                    name="representant_assurance"
                    v-model="representant_assurance"
                    class="form-control"
                    id="representant_assurance"
                />
                <span
                    v-if="messages.representant_assurance.exist"
                    class="text-danger"
                    >{{ messages.representant_assurance.value }}</span
                >
            </div>
            <div class="form-group col-md-6">
                <label for="contact_assurance">Contact Assurance</label>
                <input
                    name="contact_assurance"
                    v-model="contact_assurance"
                    class="form-control"
                    id="contact_assurance"
                />
                <span
                    v-if="messages.contact_assurance.exist"
                    class="text-danger"
                    >{{ messages.contact_assurance.value }}</span
                >
            </div>
            <div class="form-group col-md-6">
                <label for="email_assurance">Email Assurance</label>
                <input
                    name="email_assurance"
                    v-model="email_assurance"
                    class="form-control"
                    id="email_assurance"
                />
                <span
                    v-if="messages.email_assurance.exist"
                    class="text-danger"
                    >{{ messages.email_assurance.value }}</span
                >
            </div>
        </div>
        <div v-if="entreprise" class="row">
            <div class="form-group col-md-6">
                <label for="nom_entreprise">Nom de l'entreprise</label>
                <input
                    name="nom_entreprise"
                    v-model="nom_entreprise"
                    class="form-control"
                    id="nom_entreprise"
                />
                <span
                    v-if="messages.nom_entreprise.exist"
                    class="text-danger"
                    >{{ messages.nom_entreprise.value }}</span
                >
            </div>
            <div class="form-group col-md-6">
                <label for="representant_entreprise"
                    >Nom du représentant de l'entreprise</label
                >
                <input
                    name="representant_entreprise"
                    v-model="representant_entreprise"
                    class="form-control"
                    id="representant_entreprise"
                />
                <span
                    v-if="messages.representant_entreprise.exist"
                    class="text-danger"
                    >{{ messages.representant_entreprise.value }}</span
                >
            </div>
            <div class="form-group col-md-6">
                <label for="contact_entreprise">Contact entreprise</label>
                <input
                    name="contact_entreprise"
                    v-model="contact_entreprise"
                    class="form-control"
                    id="contact_entreprise"
                />
                <span
                    v-if="messages.contact_entreprise.exist"
                    class="text-danger"
                    >{{ messages.contact_entreprise.value }}</span
                >
            </div>
            <div class="form-group col-md-6">
                <label for="email_entreprise">Email entreprise</label>
                <input
                    name="email_entreprise"
                    v-model="email_entreprise"
                    class="form-control"
                    id="email_entreprise"
                />
                <span
                    v-if="messages.email_entreprise.exist"
                    class="text-danger"
                    >{{ messages.email_entreprise.value }}</span
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        erreurs: Array
    },
    data() {
        return {
            particulier: false,
            assurance: false,
            entreprise: false,
            nouveau_client: false,
            kind: null,
            contact: "",
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
            messages: {
                nom_complet: {
                    exist: false,
                    value: null
                },
                telephone: {
                    exist: false,
                    value: null
                },
                email: {
                    exist: false,
                    value: null
                },
                nom_assurance: {
                    exist: false,
                    value: null
                },
                representant_assurance: {
                    exist: false,
                    value: null
                },
                contact_assurance: {
                    exist: false,
                    value: null
                },
                email_assurance: {
                    exist: false,
                    value: null
                },
                nom_entreprise: {
                    exist: false,
                    value: null
                },
                representant_entreprise: {
                    exist: false,
                    value: null
                },
                contact_entreprise: {
                    exist: false,
                    value: null
                },
                email_entreprise: {
                    exist: false,
                    value: null
                }
            }
        };
    },
    methods: {
        cocher() {
            if (this.kind === "assurance") {
                this.assurance = true;
                this.particulier = !this.assurance;
                this.entreprise = !this.assurance;
            } else if (this.kind === "entreprise") {
                this.entreprise = true;
                this.particulier = !this.entreprise;
                this.assurance = !this.entreprise;
            } else {
                this.particulier = true;
                this.entreprise = !this.particulier;
                this.assurance = !this.particulier;
            }
        },
        rechercher() {
            axios
                .get("/systeme/async/personne/find/" + this.contact)
                .then(result => {
                    let personne = result.data.personne;
                    if (personne) {
                        this.$bvToast.toast(
                            "Un client possedant ce contact existe",
                            {
                                title: "INFORMATION",
                                solid: true,
                                variant: "info"
                            }
                        );
                        this.nouveau_client = true;
                        if (result.data.nature === "assurance") {
                            this.kind = "assurance";
                            this.assurance = true;
                            this.particulier = false;
                            this.entreprise = false;
                            this.contact_assurance = personne.contact_assurance;
                            this.email_assurance = personne.email_assurance;
                            this.nom_assurance = personne.nom_assurance;
                            this.representant_assurance =
                                personne.representant_assurance;
                        } else if (result.data.nature === "entreprise") {
                            this.kind = "entreprise";
                            this.entreprise = true;
                            this.particulier = false;
                            this.assurance = false;
                            this.contact_entreprise =
                                personne.contact_entreprise;
                            this.email_entreprise = personne.email_entreprise;
                            this.nom_entreprise = personne.nom_entreprise;
                            this.representant_entreprise =
                                personne.representant_entreprise;
                        } else {
                            this.kind = "particulier";
                            this.particulier = true;
                            this.entreprise = false;
                            this.assurance = false;
                            this.nom_complet = personne.nom_complet;
                            this.telephone = personne.telephone;
                            this.email = personne.email;
                        }
                    } else {
                        this.$bvToast.toast(
                            "Aucun client possedant ce contact n'as été trouvé",
                            {
                                title: "INFORMATION",
                                solid: true,
                                variant: "info"
                            }
                        );
                    }
                })
                .catch(err => {});
        },
        etat_initial() {
            this.nouveau_client = false;
            this.particulier = false;
            this.assurance = false;
            this.entreprise = false;
            this.kind = null;
            this.contact = "";
            this.nom_complet = "";
            this.telephone = "";
            this.email = "";
            this.nom_assurance = "";
            this.representant_assurance = "";
            this.contact_assurance = "";
            this.email_assurance = "";
            this.nom_entreprise = "";
            this.representant_entreprise = "";
            this.contact_entreprise = "";
            this.email_entreprise = "";
        }
    }
};
</script>

<style></style>
