<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="form-inline">
                    <div class="row">
                        <div class="col-5">
                            <label class="sr-only">Nom</label>
                            <input
                                type="zone"
                                v-model="zone.nom"
                                class="form-control"
                                placeholder="Ex: zone nord"
                            />
                        </div>
                        <div class="col-5">
                            <label class="sr-only">Code</label>
                            <input
                                type="zone"
                                v-model="zone.code"
                                class="form-control"
                                placeholder="identifiant de la zone Ex: A"
                            />
                        </div>
                        <div class="col-2">
                            <button
                                style="float: right"
                                @click="add"
                                type="button"
                                class="btn btn-primary mb-2"
                            >
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
            <!-- tableau -->
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div v-if="zones.length > 0">
                    <table class="table table-bordered">
                        <thead>
                            <th>Nom zone</th>
                            <th>identifiant</th>
                        </thead>
                        <tbody>
                            <tr v-for="zone in zones" :key="zone.code">
                                <td>{{ zone.nom }}</td>
                                <td>{{ zone.code }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from "./store";
export default {
    data() {
        return {
            zones: [],
            zone: {
                code: null,
                nom: null
            }
        };
    },
    updated() {
        store.state.zones = this.zones;
    },
    methods: {
        add() {
            if (this.zone.nom && this.zone.code) {
                if (!this.codeFounds()) {
                    this.zones.push(this.zone);
                    this.zone = { code: null, nom: null };
                } else {
                    this.notifier(
                        "Code ou nom de zone déjà utilisé",
                        "DUPPLICATION DETECTEE",
                        "warning"
                    );
                }
            }
        },
        codeFounds() {
            let found = false;
            this.zones.forEach(zone => {
                if (zone.code == this.zone.code || zone.nom == this.zone.nom) {
                    found = true;
                }
            });
            return found;
        },
        notifier(message, titre, variant) {
            this.$bvToast.toast(message, {
                title: titre,
                solid: true,
                variant: variant
            });
        }
    }
};
</script>

<style></style>
