<template></template>

<script>
export default {
    props: {
        message: String,
        variant: String,
        titre: String,
        lien: String
    },
    mounted() {
        this.notifications();
    },
    methods: {
        notifications() {
            this.$bvToast.toast(this.message, {
                title: this.titre,
                solid: true,
                variant: this.variant,
                href: this.lien
            });
        }
    }
};
</script>

<style></style>
