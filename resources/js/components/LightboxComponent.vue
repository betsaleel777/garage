<template>
	<div>
		<a href="#" @click="toggler = !toggler">
			{{ message }}
		</a>
		<FsLightbox :toggler="toggler" :sources="images" />
	</div>
</template>

<script>
import FsLightbox from "fslightbox-vue"
export default {
	props: {
		message: {
			type: String,
			required: true,
		},
		sources: {
			type: [Array, Object],
			default() {
				return []
			},
		},
		source: {
			type: String,
		},
	},
	components: { FsLightbox },
	mounted() {
		if (this.sources.length > 0) {
			this.images = this.sources
		} else {
			this.images.push(this.source)
		}
		console.log(this.images)
	},
	data() {
		return {
			toggler: false,
			images: [],
		}
	},
}
</script>
