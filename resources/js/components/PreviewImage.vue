<template>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3" v-if="imageData.length > 0">
                <img width="200" class="preview" :src="imageData" />
            </div>
            <div class="col-md-6 form-group">
                <label :for="field">{{ field }}</label>
                <input
                    type="file"
                    @change="previewImage"
                    accept="image/*"
                    :name="field"
                    :id="field"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        field: String
    },
    data() {
        return {
            imageData: ""
        };
    },
    methods: {
        previewImage(event) {
            // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = e => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    this.imageData = e.target.result;
                };
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
};
</script>

<style scoped>
.preview {
    background-color: white;
    border: 1px solid black;
    padding: 4px;
}
</style>
