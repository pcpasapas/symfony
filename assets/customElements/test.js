export default class Test extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `
        <h1>Test Custom Element</h1>
        <style>
        h1 {
            background-color: red;
            color: blue
        }
        </style>
        `
        let button = document.createElement('button')
        this.appendChild(button)
        button.innerHTML = 'Test Bouton Element'
        button.onclick = () => {
            console.log(this.innerHTML)
            button.classList.add('btn')
            button.classList.add('btn-primary')
        }


    }
}

