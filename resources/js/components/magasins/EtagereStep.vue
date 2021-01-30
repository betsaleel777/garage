<template>
    <div class="container">
        <div v-if="nouveau" class="row">
            <p>{{ current.nom }}</p>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="form-inline">
                    <div class="row">
                        <div class="col-5">
                            <label class="sr-only">Nom</label>
                            <input
                                type="text"
                                v-model="etagere.nom"
                                class="form-control"
                                placeholder="Ex: étagère nord"
                            />
                        </div>
                        <div class="col-5">
                            <label class="sr-only">Code</label>
                            <input
                                type="text"
                                v-model="etagere.code"
                                class="form-control"
                                placeholder="identifiant de la etagere Ex: A"
                            />
                        </div>
                        <div class="col-2">
                            <button
                                style="float: right"
                                @click="add(current.code)"
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
                <div v-if="etageres.length > 0">
                    <table class="table table-bordered">
                        <thead>
                            <th>Nom étagères</th>
                            <th>identifiant</th>
                        </thead>
                        <tbody>
                            <tr v-for="etagere in etageres" :key="etagere.code">
                                <td>{{ etagere.nom }}</td>
                                <td>{{ etagere.code }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div v-show="!nouveau" class="row">
            <p>{{ current_zone.nom }}</p>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="form-inline">
                    <div class="row">
                        <div class="col-5">
                            <label class="sr-only">Nom</label>
                            <input
                                type="text"
                                v-model="etagere.nom"
                                class="form-control"
                                placeholder="Ex: étagère nord"
                            />
                        </div>
                        <div class="col-5">
                            <label class="sr-only">Code</label>
                            <input
                                type="text"
                                v-model="etagere.code"
                                class="form-control"
                                placeholder="identifiant de la etagere Ex: A"
                            />
                        </div>
                        <div class="col-2">
                            <button
                                :disabled="disabled"
                                style="float: right"
                                @click="add(current_zone.code)"
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
                <div v-if="etageres.length > 0">
                    <table class="table table-bordered">
                        <thead>
                            <th>Nom étagères</th>
                            <th>identifiant</th>
                        </thead>
                        <tbody>
                            <tr v-for="etagere in etageres" :key="etagere.code">
                                <td>{{ etagere.nom }}</td>
                                <td>{{ etagere.code }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</template>

<script>
// import store from "./store";
export default {
    props: {
        zones: Array,
        current: Object
    },
    data() {
        return {
            etageres: [],
            current_zone: {},
            disabled: false,
            index: 0,
            nouveau: true,
            etagere: {
                nom: null,
                code: null,
                zone: null
            }
        };
    },
    methods: {
        add(code) {
            if (this.etagere.nom && this.etagere.code) {
                if (!this.codeFounds()) {
                    this.etagere.zone = code;
                    this.etageres.push(this.etagere);
                    this.etagere = { code: null, nom: null, zone: null };
                    if (this.nouveau) {
                        this.nouveau = false;
                    }
                    this.index++;
                    if (this.zones[this.index]) {
                        this.current_zone = this.zones[this.index];
                    } else {
                        this.notifier(
                            "Toutes les zones ont déjà été utilisées",
                            "INFORMATIONS",
                            "info"
                        );
                        this.disabled = true;
                    }
                } else {
                    this.notifier(
                        "Code ou nom de étagère déjà utilisé",
                        "DUPPLICATION DETECTEE",
                        "warning"
                    );
                }
            }
        },
        codeFounds() {
            let found = false;
            this.etageres.forEach(etagere => {
                if (
                    etagere.code == this.etagere.code ||
                    etagere.nom == this.etagere.nom
                ) {
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
