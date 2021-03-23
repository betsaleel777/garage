<template>
	<div>
		<table style="margin-top:2%" class="show-table">
			<thead>
				<tr>
					<th style="width:5%">#</th>
					<th style="width:10%">Référence</th>
					<th style="width:35%">Nom</th>
					<th style="width:10%">Prix d'achat</th>
					<th style="width:10%">Prix de vente</th>
					<th style="width:5%">Demandé</th>
					<th style="width:5%">OK</th>
					<th style="width:5%">Quantité</th>
					<th class="text-right">Subtotal</th>
				</tr>
			</thead>
			<tbody v-if="fields.length > 0">
				<tr v-for="element in fields" :key="element.id">
					<td>{{ element.numero }}</td>
					<td>#{{ element.reference }}</td>
					<td>{{ element.name }}</td>
					<td>
						<input
							@input="achat($event.target.value, element.id)"
							:value="element.achat"
							class="form-control form-control-sm"
							type="number"
						/>
					</td>
					<td>
						<input
							@input="vente($event.target.value, element.id)"
							:value="element.vente"
							class="form-control form-control-sm"
							type="number"
						/>
					</td>
					<td>
						{{ element.demande }}
					</td>
					<td>
						{{ element.deja }}
					</td>
					<td>
						<input
							@input="quantite($event.target.value, element.id)"
							:value="element.quantite"
							class="form-control form-control-sm"
							type="number"
						/>
					</td>
					<td style="text-align:right">
						{{
							new Intl.NumberFormat("fr-FR", { style: "currency", currency: "XOF" }).format(
								subtotal(element.achat, element.quantite, element.id)
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
					<th colspan="7">Total</th>
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
	async mounted() {
		compteur = 0
		const response = await this.axios.get("/systeme/async/commandes/deja/" + store.state.demande.id)
		const totalDejaDemande = response.data.deja
		console.log(totalDejaDemande)
		store.state.demande.pieces.forEach(async piece => {
			const response = await this.axios.get("/systeme/async/stock/vehicule/" + piece.pivot.vehicule)
			this.fields.push({
				numero: compteur,
				id: piece.id,
				reference: piece.code,
				name: `${piece.nom} (${response.data.vehicule.designation})`,
				vehicule: piece.pivot.vehicule,
				achat: 0,
				vente: 0,
				deja: totalDejaDemande[piece.id + "-" + piece.pivot.vehicule],
				demande: piece.pivot.quantite,
				quantite: 0,
			})
		})
		this.subtotaux = []
		this.fields.forEach(item => {
			this.subtotaux.push({ id: item.id, value: item.achat * item.quantite })
		})
	},
	updated() {
		store.state.pieces = JSON.parse(JSON.stringify(this.fields))
	},
	data() {
		return {
			subtotaux: [],
			fields: [],
		}
	},
	methods: {
		achat(value, id) {
			value ? null : (value = 0)
			this.fields.forEach(field => {
				if (field.id === id) field.achat = value
			})
		},
		vente(value, id) {
			value ? null : (value = 0)
			this.fields.forEach(field => {
				if (field.id === id) field.vente = value
			})
		},
		quantite(value, id) {
			value ? null : (value = 0)
			this.fields.forEach(field => {
				if (field.id === id) field.quantite = value
			})
		},
		subtotal(prix, quantite, id) {
			const total = Number(prix) * Number(quantite)
			this.subtotaux.forEach(object => {
				if (object.id === id) object.value = total
			})
			return total
		},
	},
}
</script>

<style></style>
