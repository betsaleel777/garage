<template></template>

<script>
export default {
    props: {
        message: String,
        variant: String,
    },
    mounted() {
        this.notifications();
    },
    methods: {
        notifications() {
            if (this.variant === "info") {
                this.$toast.info(this.message);
            } else if (this.variant === "success") {
                console.log("pass");
                this.$toast.success(this.message);
            } else if (this.variant === "warning") {
                this.$toast.warning(this.message);
            } else {
                this.$toast.error(this.message);
            }
        },
    },
};
</script>

<style>
@import "~vue-toastification/dist/index.css";
</style>
