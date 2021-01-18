<template>
    <a class="text-danger" @click="dialog"
        ><i class="fas fa-lg fa-trash-alt"></i
    ></a>
</template>

<script>
export default {
    props: {
        redirect: String,
        identifiant: {
            type: Number,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    },
    methods: {
        dialog() {
            this.$bvModal
                .msgBoxConfirm("Voulez vous réelement supprimer ?", {
                    title: "Confirmer la suppression",
                    size: "md",
                    buttonSize: "sm",
                    okVariant: "danger",
                    okTitle: "Confirmer",
                    cancelTitle: "Abandonner",
                    footerClass: "p-2",
                    hideHeaderClose: false,
                    centered: true
                })
                .then(value => {
                    if (value) {
                        axios
                            .get(this.url + this.identifiant)
                            .then(result => {
                                if (result.data.message) {
                                    this.force();
                                } else {
                                    location.reload();
                                }
                            })
                            .catch(err => {});
                    }
                })
                .catch(err => {
                    // An error occurred
                });
        },
        force() {
            this.$bvModal
                .msgBoxConfirm(
                    "la suppression définitive de l'elements avec ses dépendances est irréversible.",
                    {
                        title: "Confirmer suppression définitive",
                        size: "md",
                        buttonSize: "sm",
                        okVariant: "danger",
                        okTitle: "Confirmer",
                        cancelTitle: "Abandonner",
                        footerClass: "p-2",
                        hideHeaderClose: false,
                        centered: true
                    }
                )
                .then(value => {
                    if (value) {
                        axios
                            .get(this.url + "/force/" + this.identifiant)
                            .then(result => {
                                location.reload();
                            })
                            .catch(err => {});
                    }
                })
                .catch(err => {
                    // An error occurred
                });
        }
    }
};
</script>

<style></style>
