<template>
    <form-wizard
        @onNextStep="nextStep"
        @onPreviousStep="previousStep"
        @onComplete="complete"
    >
        <tab-content title="Magasin" :selected="true">
            <magasin-step />
        </tab-content>
        <tab-content title="Zones">
            <zone-step />
        </tab-content>
        <tab-content title="Etagères">
            <etageres-step :zones="zones" :current="zones[0]" />
        </tab-content>
        <tab-content title="Contenu">
            <content-step />
        </tab-content>
    </form-wizard>
</template>

<script>
import { FormWizard, TabContent } from "vue-step-wizard";

import ZoneStep from "./ZoneStep.vue";
import EtageresStep from "./EtagereStep.vue";
import MagasinStep from "./MagasinStep.vue";
import ContentStep from "./ContentStep.vue";

import store from "./store";

export default {
    components: {
        MagasinStep,
        ZoneStep,
        EtageresStep,
        ContentStep,
        FormWizard,
        TabContent
    },
    data() {
        return {
            zones: []
        };
    },
    methods: {
        nextStep() {
            store.increment();
            if (store.state.stepId === 3) {
                this.zones = store.state.zones;
            }
        },
        previousStep() {
            store.decrement();
            if (store.state.stepId === 2) {
                store.state.zones = null;
            }
        },
        complete() {
            console.log(store);
        }
    }
};
</script>

<style></style>
