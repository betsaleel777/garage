<template>
	<div class="form-row">
		<div class="col-11">
			<label for="pieces">Pieces</label>
			<vue-select id="pieces" v-model="piece" :options="pieces"></vue-select>
		</div>
		<div class="col-1">
			<button type="button" class="btn btn-primary btn-flat btn-sm ui-button">
				<i class="fas fa-plus-circle fa-lg"></i>
			</button>
		</div>
	</div>
</template>

<script>
import VueSelect from "vue-select"
export default {
	components: {
		VueSelect,
	},
	props: {
		pieces: {
			type: [Array, Object],
			required: true,
		},
	},
	mounted() {},
	data() {
		return {
			piece: "",
		}
	},
}
</script>

<style></style>
