class Store {
    constructor() {
        this.state = {
            pieces: [],
            fournisseur: null,
            demande: {}
        };
    }
}

export default new Store();
