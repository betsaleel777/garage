<template>
    <b-link>
        <b-dropdown
            variant="link"
            toggle-class="text-decoration-none"
            no-caret
            text="Stock"
        >
            <b-dropdown-item @click="rediriger('/systeme/magasin/index')"
                >Magasins</b-dropdown-item
            >
            <b-dropdown-item @click="rediriger('/systeme/categorie/index')"
                >Categories</b-dropdown-item
            >
            <b-dropdown-item @click="rediriger('/systeme/fabricant/index')"
                >Fabricants</b-dropdown-item
            >
            <b-dropdown-item @click="rediriger('/systeme/fournisseur/index')"
                >Fournisseurs</b-dropdown-item
            >
        </b-dropdown>
    </b-link>
</template>

<script>
import { BDropdown, BDropdownItem, BLink } from "bootstrap-vue";
export default {
    name: "MenuItemStock",
    components: {
        BDropdown,
        BDropdownItem,
        BLink
    },
    props: {
        controller: String
    },
    data() {
        return {
            controllers: ["CategoriesController", "MagasinsController"],
            used: false
        };
    },
    mounted() {
        this.used = this.controllers.includes(this.controller);
    },
    methods: {
        rediriger(lien) {
            location.href = lien;
        }
    }
};
</script>

<style></style>
