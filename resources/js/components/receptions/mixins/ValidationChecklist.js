export default {
    data: function () {
        return {
            messages: {
                eclairage_int: {
                    exist: false,
                    value: null
                },
                retroviseurs_int: {
                    exist: false,
                    value: null
                },
                klaxon: {
                    exist: false,
                    value: null
                },
                essuies_glace: {
                    exist: false,
                    value: null
                },
                radio: {
                    exist: false,
                    value: null
                },
                climatisation: {
                    exist: false,
                    value: null
                },
                frein_stationnement: {
                    exist: false,
                    value: null
                },
                sieges: {
                    exist: false,
                    value: null
                },
                tableau_bord: {
                    exist: false,
                    value: null
                },
                leve_vitre: {
                    exist: false,
                    value: null
                },
                verrouillage_portes: {
                    exist: false,
                    value: null
                },
                ouverture_portes_int: {
                    exist: false,
                    value: null
                },
                roues: {
                    exist: false,
                    value: null
                },
                feux_arrieres: {
                    exist: false,
                    value: null
                },
                balais_essuies_glace_av: {
                    exist: false,
                    value: null
                },
                balais_essuies_glace_ar: {
                    exist: false,
                    value: null
                },
                trape_carburant: {
                    exist: false,
                    value: null
                },
                ouverture_portes_ext: {
                    exist: false,
                    value: null
                },
                retroviseurs_ext: {
                    exist: false,
                    value: null
                },
                cle_contact: {
                    exist: false,
                    value: null
                },
                clignotants: {
                    exist: false,
                    value: null
                },
                veilleuses: {
                    exist: false,
                    value: null
                },
                feux_croisement: {
                    exist: false,
                    value: null
                },
                feux_recul: {
                    exist: false,
                    value: null
                },
                feux_stop: {
                    exist: false,
                    value: null
                },
                feux_antibrouillard: {
                    exist: false,
                    value: null
                },
                cric: {
                    exist: false,
                    value: null
                },
                roues_secours: {
                    exist: false,
                    value: null
                },
                manivelle: {
                    exist: false,
                    value: null
                },
                trousse: {
                    exist: false,
                    value: null
                },
                huile_moteur: {
                    exist: false,
                    value: null
                },
                huile_frein: {
                    exist: false,
                    value: null
                },
                huile_direction: {
                    exist: false,
                    value: null
                },
                liquide_refroidissement: {
                    exist: false,
                    value: null
                },
                liquide_lave_glace: {
                    exist: false,
                    value: null
                }
            }
        }
    },
    methods: {
        erreurs() {
            if (this.errors.eclairage_int) {
                this.messages.eclairage_int.exist = true;
                this.messages.eclairage_int.value = this.errors.eclairage_int;
            }
            if (this.errors.retroviseurs_int) {
                this.messages.retroviseurs_int.exist = true;
                this.messages.retroviseurs_int.value = this.errors.retroviseurs_int;
            }
            if (this.errors.klaxon) {
                this.messages.klaxon.exist = true;
                this.messages.klaxon.value = this.errors.klaxon;
            }
            if (this.errors.essuies_glace) {
                this.messages.essuies_glace.exist = true;
                this.messages.essuies_glace.value = this.errors.essuies_glace;
            }
            if (this.errors.radio) {
                this.messages.radio.exist = true;
                this.messages.radio.value = this.errors.radio;
            }
            if (this.errors.climatisation) {
                this.messages.climatisation.exist = true;
                this.messages.climatisation.value = this.errors.climatisation;
            }
            if (this.errors.frein_stationnement) {
                this.messages.frein_stationnement.exist = true;
                this.messages.frein_stationnement.value = this.errors.frein_stationnement;
            }
            if (this.errors.sieges) {
                this.messages.sieges.exist = true;
                this.messages.sieges.value = this.errors.sieges;
            }
            if (this.errors.tableau_bord) {
                this.messages.tableau_bord.exist = true;
                this.messages.tableau_bord.value = this.errors.tableau_bord;
            }
            if (this.errors.leve_vitre) {
                this.messages.leve_vitre.exist = true;
                this.messages.leve_vitre.value = this.errors.leve_vitre;
            }
            if (this.errors.verrouillage_portes) {
                this.messages.verrouillage_portes.exist = true;
                this.messages.verrouillage_portes.value = this.errors.verrouillage_portes;
            }
            if (this.errors.ouverture_portes_int) {
                this.messages.ouverture_portes_int.exist = true;
                this.messages.ouverture_portes_int.value = this.errors.ouverture_portes_int;
            }
            if (this.errors.roues) {
                this.messages.roues.exist = true;
                this.messages.roues.value = this.errors.roues;
            }
            if (this.errors.feux_arrieres) {
                this.messages.feux_arrieres.exist = true;
                this.messages.feux_arrieres.value = this.errors.feux_arrieres;
            }
            if (this.errors.balais_essuies_glace_av) {
                this.messages.balais_essuies_glace_av.exist = true;
                this.messages.balais_essuies_glace_av.value = this.errors.balais_essuies_glace_av;
            }
            if (this.errors.balais_essuies_glace_ar) {
                this.messages.balais_essuies_glace_ar.exist = true;
                this.messages.balais_essuies_glace_ar.value = this.errors.balais_essuies_glace_ar;
            }
            if (this.errors.trape_carburant) {
                this.messages.trape_carburant.exist = true;
                this.messages.trape_carburant.value = this.errors.trape_carburant;
            }
            if (this.errors.ouverture_portes_ext) {
                this.messages.ouverture_portes_ext.exist = true;
                this.messages.ouverture_portes_ext.value = this.errors.ouverture_portes_ext;
            }
            if (this.errors.retroviseurs_ext) {
                this.messages.retroviseurs_ext.exist = true;
                this.messages.retroviseurs_ext.value = this.errors.retroviseurs_ext;
            }
            if (this.errors.cle_contact) {
                this.messages.cle_contact.exist = true;
                this.messages.cle_contact.value = this.errors.cle_contact;
            }
            if (this.errors.clignotants) {
                this.messages.clignotants.exist = true;
                this.messages.clignotants.value = this.errors.clignotants;
            }
            if (this.errors.veilleuses) {
                this.messages.veilleuses.exist = true;
                this.messages.veilleuses.value = this.errors.veilleuses;
            }
            if (this.errors.feux_croisement) {
                this.messages.feux_croisement.exist = true;
                this.messages.feux_croisement.value = this.errors.feux_croisement;
            }
            if (this.errors.feux_recul) {
                this.messages.feux_recul.exist = true;
                this.messages.feux_recul.value = this.errors.feux_recul;
            }
            if (this.errors.feux_stop) {
                this.messages.feux_stop.exist = true;
                this.messages.feux_stop.value = this.errors.feux_stop;
            }
            if (this.errors.feux_antibrouillard) {
                this.messages.feux_antibrouillard.exist = true;
                this.messages.feux_antibrouillard.value = this.errors.feux_antibrouillard;
            }
            if (this.errors.cric) {
                this.messages.cric.exist = true;
                this.messages.cric.value = this.errors.cric;
            }
            if (this.errors.roues_secours) {
                this.messages.roues_secours.exist = true;
                this.messages.roues_secours.value = this.errors.roues_secours;
            }
            if (this.errors.manivelle) {
                this.messages.manivelle.exist = true;
                this.messages.manivelle.value = this.errors.manivelle;
            }
            if (this.errors.trousse) {
                this.messages.trousse.exist = true;
                this.messages.trousse.value = this.errors.trousse;
            }
            if (this.errors.huile_moteur) {
                this.messages.huile_moteur.exist = true;
                this.messages.huile_moteur.value = this.errors.huile_moteur;
            }
            if (this.errors.huile_frein) {
                this.messages.huile_frein.exist = true;
                this.messages.huile_frein.value = this.errors.huile_frein;
            }
            if (this.errors.huile_direction) {
                this.messages.huile_direction.exist = true;
                this.messages.huile_direction.value = this.errors.huile_direction;
            }
            if (this.errors.liquide_refroidissement) {
                this.messages.liquide_refroidissement.exist = true;
                this.messages.liquide_refroidissement.value = this.errors.liquide_refroidissement;
            }
            if (this.errors.liquide_lave_glace) {
                this.messages.liquide_lave_glace.exist = true;
                this.messages.liquide_lave_glace.value = this.errors.liquide_lave_glace;
            }
        },
    }
}
