class Store {
    constructor() {
        this.state = {
            zones: [],
            nom: null,
            lieu: null,
            etageres: [],
            stepId: 1,
        };
    }

    increment() {
        this.state.stepId++
    }

    decrement() {
        this.state.stepId--
    }
}

export default new Store();
