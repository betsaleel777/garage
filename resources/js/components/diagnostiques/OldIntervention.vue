<template>
    <div>
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
        <div v-if="diagnostique.exist" class="alert alert-success" role="alert">
            <h4 class="alert-heading">Panne Trouvée!</h4>
            <p>
                {{ diagnostique.value.panne }}
            </p>
            <hr />
            <p class="mb-0">
                le délais provisoire estimé pour la réparation est de:
                {{ diagnostique.value.temps }}
            </p>
            <div class="temps">
                <small class="text-muted"
                    ><b>{{ diagnostique.value.closed_from }}</b></small
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
            diagnostique: {
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
        this.$root.$on("fermeture", diagnostique => {
            this.diagnostique.exist = true;
            this.diagnostique.value = diagnostique;
        });
    }
};
</script>

<style scoped>
.temps {
    text-align: right;
}
</style>
