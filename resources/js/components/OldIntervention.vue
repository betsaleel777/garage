<template>
    <div>
        <div class="temps row">
            <div class="col-md-9"></div>
            <div v-if="data_interventions.length > 0" class="col-md-3">
                <b-dropdown
                    right
                    text="grouper par "
                    variant="primary"
                    class="m-2"
                >
                    <b-dropdown-item @click="groupByUser"
                        >Technicien</b-dropdown-item
                    >
                    <b-dropdown-item @click="groupByAtelier"
                        >Atelier</b-dropdown-item
                    >
                </b-dropdown>
            </div>
        </div>
        <div v-if="data_interventions.length > 0">
            <div
                v-for="data in data_interventions"
                :key="data.id"
                class="form-group"
            >
                <div class="row">
                    <div class="col-md-9">
                        <span
                            ><b>{{ data.atelier }}:</b>
                            {{ data.utilisateur }}</span
                        >
                    </div>
                    <div style="text-align: right" class="col-md-3">
                        <small class="text-muted"
                            ><i class="fas fa-sm fa-clock"></i>
                            {{ data.created_from }}</small
                        >
                    </div>
                </div>
                <textarea
                    class="form-control"
                    v-model="data.commentaire"
                    disabled
                    cols="30"
                    rows="3"
                >
                </textarea>
            </div>
        </div>
        <div v-if="rapport.exist" class="alert alert-success" role="alert">
            <h4 class="alert-heading">Panne Trouvée!</h4>
            <p>
                {{ rapport.value.panne }}
            </p>
            <hr />
            <p class="mb-0">
                le délais provisoire estimé pour la réparation est de:
                {{ rapport.value.temps }}
            </p>
            <div class="temps">
                <small class="text-muted"
                    ><b>{{ rapport.value.closed_from }}</b></small
                >
            </div>
        </div>
        <div v-if="resume.exist" class="alert alert-success" role="alert">
            <h4 class="alert-heading">Fin des travaux!</h4>
            <p>
                {{ resume.value.texte }}
            </p>
            <hr />
            <div class="temps">
                <small class="text-muted"
                    ><b>{{ resume.value.closed_from }}</b></small
                >
            </div>
        </div>
    </div>
</template>

<script>
import { BDropdown, BDropdownItem } from "bootstrap-vue";
const groupageAtelier = function(objet) {
    return Object.values(
        objet.reduce((acc, value) => {
            if (!acc[value.atelier]) {
                acc[value.atelier] = [];
            }
            acc[value.atelier].push(value);
            return acc;
        }, {})
    ).flat();
};
const groupageUser = function(objet) {
    return Object.values(
        objet.reduce((acc, value) => {
            if (!acc[value.utilisateur]) {
                acc[value.utilisateur] = [];
            }
            acc[value.utilisateur].push(value);
            return acc;
        }, {})
    ).flat();
};
export default {
    components: {
        BDropdown,
        BDropdownItem
    },
    props: {
        interventions: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    data() {
        return {
            data_interventions: [],
            rapport: {
                exist: false,
                value: {}
            },
            resume: {
                exist: false,
                value: {}
            }
        };
    },
    mounted() {
        this.data_interventions = this.interventions;
        this.$root.$on("new-comment", intervention => {
            this.data_interventions.push(intervention);
        });
        this.$root.$on("fermeture", rapport => {
            this.rapport.exist = true;
            this.rapport.value = rapport;
        });
        this.$root.$on("finished", resume => {
            this.resume.exist = true;
            this.resume.value = resume;
        });
    },
    methods: {
        groupByUser() {
            const interventions = this.data_interventions;
            this.data_interventions = groupageUser(interventions);
        },
        groupByAtelier() {
            const interventions = this.data_interventions;
            this.data_interventions = groupageAtelier(interventions);
        }
    }
};
</script>

<style scoped>
.temps {
    text-align: right;
}
</style>
