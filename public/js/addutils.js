function welldone(params) {
    const inputs = document.getElementById('etat').getElementsByTagName('select')
    for (let index = 0; index < inputs.length; index++) {
        inputs[index].innerHTML = `<option value="inexistant">inexistant</option> <option selected value="bon">bon</option> <option value="passable">passable</option> <option value="mauvais">mauvais</option>`
    }
}
