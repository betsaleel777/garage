<template>
	<GChart
		ref="gChart"
		:settings="{ packages: ['treemap'] }"
		:events="chartEvents"
		type="TreeMap"
		:data="chartData"
		:options="chartOptions"
	/>
</template>

<script>
import { GChart } from "vue-google-charts"
export default {
	props: {
		donnees: {
			type: [Array, Object],
			required: true,
		},
	},
	components: {
		GChart,
	},
	mounted() {
		let donneesFormatees = [
			["Racine", "Parent", "Nombre", "Couleur"],
			["zones", null, 0, 0],
		]
		if (this.donnees.zones.length > 0) {
			this.donnees.zones.forEach(zone => {
				const nomZone = zone.nom
				const nombreEtagere = zone.etageres.length + 10
				donneesFormatees.push([nomZone, "zones", nombreEtagere, -52])
				let numeroTiroir = 1
				zone.etageres.forEach(etagere => {
					const etagereNom = etagere.nom
					const nombreTiroir = etagere.tiroirs.length + 10
					donneesFormatees.push([etagereNom, nomZone, nombreTiroir, -63])
					numeroTiroir++
					etagere.tiroirs.forEach(tiroir => {
						const tiroirNom = "#" + numeroTiroir + " " + tiroir.nom + "-" + tiroir.id
						donneesFormatees.push([tiroirNom, etagereNom, 5, -52])
					})
				})
			})
		} else {
			donneesFormatees = [
				["Racine", "Parent", "Nombre", "Couleur"],
				["etageres", null, 0, 0],
			]
			let numeroTiroir = 1
			this.donnees.etageres.forEach(etagere => {
				const etagereNom = etagere.nom
				donneesFormatees.push([etagereNom, "etageres", 0, 0])
				numeroTiroir++
				etagere.tiroirs.forEach(tiroir => {
					const tiroirNom = "#" + numeroTiroir + " " + tiroir.nom + "-" + tiroir.id
					donneesFormatees.push([tiroirNom, etagereNom, 5, -52])
				})
			})
		}
		this.chartData = donneesFormatees
	},
	data() {
		return {
			chartData: [],
			chartOptions: {
				chart: {
					title: "Présentation du magasin",
					subtitle: "zones, étagères, tiroirs, ...",
					minColor: "#e7711c",
					midColor: "#fff",
					maxColor: "#4374e0",
					showScale: true,
				},
				// generateTooltip: (row, size, value) => {
				// 	const table = this.$refs.gChart.chartObject
				// 	return `<div style="background:#fd9; padding:10px; border-style:solid">
				//               ${row},${size},${value}.
				//             </div>`
				// },
			},
			chartEvents: {
				select: () => {
					const table = this.$refs.gChart.chartObject
					const selection = table.getSelection()
					if (selection.length !== 0) {
						const [name, ...rest] = this.chartData[selection[0].row + 1]
						const id = parseInt(name.split("-")[1])
						if (!isNaN(id)) {
							location.href = "/systeme/tiroir/show/" + id
						}
					}
				},
			},
		}
	},
	methods: {},
}
</script>

<style></style>
