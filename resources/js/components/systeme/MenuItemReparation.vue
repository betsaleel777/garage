<template>
	<b-link>
		<b-dropdown variant="link" toggle-class="text-decoration-none" no-caret text="Réparations">
			<b-dropdown-item @click="rediriger('/systeme/types_reparation/index')">Type de réparations</b-dropdown-item>
			<b-dropdown-item @click="rediriger('/systeme/atelier/index')">Ateliers</b-dropdown-item>
		</b-dropdown>
	</b-link>
</template>

<script>
import { BDropdown, BDropdownItem, BLink } from "bootstrap-vue"
export default {
	name: "MenuItemStock",
	components: {
		BDropdown,
		BDropdownItem,
		BLink,
	},
	props: {
		controller: String,
	},
	data() {
		return {
			controllers: ["AteliersController", "TypesReparationsController"],
			used: false,
		}
	},
	mounted() {
		this.used = this.controllers.includes(this.controller)
	},
	methods: {
		rediriger(lien) {
			let urlProd = "/projects/garage/systeme/"
			let local = "/systeme/"
			location.href = local + lien
		},
	},
}
</script>

<style></style>
