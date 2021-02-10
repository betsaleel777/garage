class Store {
    constructor() {
        this.state = {
            magasin: {},
            zones: [],
            etageres: [],
            tiroirs: [],
            step: 0
        };
    }

    increment() {
        this.state.step++
    }

    decrement() {
        this.state.step--
    }
}

export default new Store();
