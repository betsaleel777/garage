<template>
	<div>
		<table style="margin-top:2%" class="show-table">
			<thead>
				<tr>
					<th style="width:5%">#</th>
					<th style="width:15%">Référence</th>
					<th style="width:30%">Nom</th>
					<th style="width:15%">Prix d'achat</th>
					<th style="width:15%">Prix de vente</th>
					<th style="width:5%">Quantité</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody v-if="fields.length > 0">
				<tr v-for="element in fields" :key="element.code">
					<td>{{ element.numero }}</td>
					<td>#{{ element.reference }}</td>
					<td>{{ element.name }}</td>
					<td>
						<input
							@input="achat($event.target.value, element.code)"
							:value="element.achat"
							class="form-control form-control-sm"
							type="number"
						/>
					</td>
					<td>
						<input
							@input="vente($event.target.value, element.code)"
							:value="element.vente"
							class="form-control form-control-sm"
							type="number"
						/>
					</td>
					<td>
						<input
							@input="quantite($event.target.value, element.code)"
							:value="element.quantite"
							class="form-control form-control-sm"
							type="number"
						/>
					</td>
					<td style="text-align:right">
						{{
							new Intl.NumberFormat("fr-FR", { style: "currency", currency: "XOF" }).format(
								subtotal(element.achat, element.quantite, element.code)
							)
						}}
					</td>
				</tr>
			</tbody>
			<tbody v-else>
				<td colspan="7">
					<center>
						<small><span class="text-primary">Aucune pieces commandées</span></small>
					</center>
				</td>
			</tbody>
			<tfoot v-if="fields.length > 0">
				<tr>
					<th colspan="6">Total</th>
					<td style="text-align:right">
						{{ new Intl.NumberFormat("fr-FR", { style: "currency", currency: "XOF" }).format(total) }}
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</template>

<script>
import store from "./store"
let compteur = 0
export default {
	computed: {
		total: function() {
			let total = 0
			this.subtotaux.forEach(element => {
				total += Number(element.value)
			})
			return total
		},
	},
	mounted() {
		compteur = 0
		this.fields = store.state.pieces.map(piece => {
			compteur++
			return { numero: compteur, ...piece }
		})
		this.subtotaux = []
		this.fields.forEach(item => {
			this.subtotaux.push({ code: item.code, value: item.achat * item.quantite })
		})
	},
	updated() {
		store.state.pieces = JSON.parse(JSON.stringify(this.fields))
	},
	data() {
		return {
			subtotaux: [],
			fields: {
				numero: 0,
				code: "",
				name: "",
				achat: 0,
				vente: 0,
			},
		}
	},
	methods: {
		achat(value, code) {
			value ? null : (value = 0)
			this.fields.forEach(field => {
				if (field.code === code) field.achat = value
			})
		},
		vente(value, code) {
			value ? null : (value = 0)
			this.fields.forEach(field => {
				if (field.code === code) field.vente = value
			})
		},
		quantite(value, code) {
			value ? null : (value = 0)
			this.fields.forEach(field => {
				if (field.code === code) field.quantite = value
			})
		},
		subtotal(prix, quantite, code) {
			const total = Number(prix) * Number(quantite)
			this.subtotaux.forEach(object => {
				if (object.code === code) object.value = total
			})
			return total
		},
	},
}
</script>

<style></style>
