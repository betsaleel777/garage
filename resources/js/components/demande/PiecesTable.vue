<template>
	<table class="show-table">
		<thead>
			<tr>
				<th style="width:20%">Code</th>
				<th style="width:70%">Nom</th>
				<th style="width:10%">Quantite</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="row in rows" :key="row.code">
				<td>{{ row.reference }}</td>
				<td>{{ row.name }}</td>
				<td>
					<input
						@input="quantite($event.target.value, row.code)"
						:value="row.quantite"
						class="form-control form-control-sm"
						type="number"
					/>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
import store from "./store"
export default {
	mounted() {
		this.rows = store.state.rowPieces
	},
	data() {
		return {
			rows: [],
		}
	},
	methods: {
		quantite(value, code) {
			value ? null : (value = 0)
			this.rows.forEach(row => {
				if (row.code === code) row.quantite = value
			})
		},
	},
}
</script>

<style></style>
