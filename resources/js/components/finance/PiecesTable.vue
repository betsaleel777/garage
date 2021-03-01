<template>
	<div>
		<table class="show-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Réfernce</th>
					<th>Nom</th>
					<th>Prix d'achat</th>
					<th>Prix de vente</th>
					<th>Quantité</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot></tfoot>
		</table>
	</div>
</template>

<script>
export default {
	props: {
		key: Object,
	},
}
</script>

<style></style>
