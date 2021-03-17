<template>
	<GChart :settings="{ packages: ['treemap'] }" type="TreeMap" :data="chartData" :options="chartOptions" />
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
						const tiroirNom = "#" + numeroTiroir + " " + tiroir.nom + "." + tiroir.id
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
					const tiroirNom = "#" + numeroTiroir + " " + tiroir.nom + "." + tiroir.id
					donneesFormatees.push([tiroirNom, etagereNom, 5, -52])
				})
			})
		}
		console.log(this.donnees, donneesFormatees)
		this.chartData = donneesFormatees
	},
	data() {
		return {
			// Array will be automatically processed with visualization.arrayToDataTable function
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
				generateTooltip: (row, size, value) => {
					return `<div style="background:#fd9; padding:10px; border-style:solid">
                                Read more about the
                                <a href="http://en.wikipedia.org/wiki/Kingdom_(biology)">kingdoms of life</a>.
                            </div>`
				},
			},
		}
	},
	methods: {},
}
</script>

<style></style>
