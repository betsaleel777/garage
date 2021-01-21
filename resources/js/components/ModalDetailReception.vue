<template>
    <b-modal
        :id="`detail-reception-${reception.id}`"
        scrollable
        :title="
            `Réception ${reception.code} DU ${convertir(reception.created_at)}`
        "
    >
        <h3 class="text-primary">Identification du véhicule</h3>
        <hr />
        <small>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Déposant</th>
                        <th>
                            {{ "Mr. " + reception.nom_deposant.toUpperCase() }}
                        </th>
                    </tr>
                    <tr>
                        <th>Véhicule</th>
                        <th>
                            {{
                                `${reception.vehicule.marque} ${reception.vehicule.modele} ${reception.vehicule.type_vehicule} ${reception.vehicule.annee} ${reception.vehicule.couleur}`
                            }}
                        </th>
                    </tr>
                    <tr>
                        <th>Immatriculation</th>
                        <th>{{ reception.vehicule.immatriculation }}</th>
                    </tr>
                    <tr>
                        <th>Chassis</th>
                        <th>{{ reception.vehicule.chassis }}</th>
                    </tr>
                    <tr>
                        <th>Kilométrage actuelle</th>
                        <th>
                            {{ reception.vehicule.kilometrage_actuel + "Km" }}
                        </th>
                    </tr>
                    <tr>
                        <th>Prochaine vidange</th>
                        <th>
                            {{ reception.vehicule.prochaine_vidange + "Km" }}
                        </th>
                    </tr>
                    <tr>
                        <th>Date de fin d'assurance</th>
                        <th>
                            {{ convertir(reception.vehicule.date_assurance) }}
                        </th>
                    </tr>
                    <tr>
                        <th>Date de fin de visite technique</th>
                        <th>{{ convertir(reception.vehicule.date_sitca) }}</th>
                    </tr>
                    <tr>
                        <th>Niveau de carburant</th>
                        <th>{{ reception.vehicule.niveau_carburant }}</th>
                    </tr>
                    <tr>
                        <th>DMC</th>
                        <th>{{ reception.vehicule.dmc }}</th>
                    </tr>
                </tbody>
            </table>
        </small>
    </b-modal>
</template>

<script>
import moment from "moment";
export default {
    props: {
        reception: Object
    },
    methods: {
        convertir(dateString) {
            return moment(dateString)
                .lang("fr")
                .format("L");
        }
    }
};
</script>

<style></style>
