import { defineCustomElement } from 'vue'

import MyVueElement from './customElementsVue/testElement.ce.vue'

const ExampleElement = defineCustomElement(MyVueElement, {shadow: false})
customElements.define('my-example', ExampleElement, {shadow: false})

// import index from './customElements/index.js'
// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.scss';
import * as bootstrap from 'bootstrap'
import * as Popper from "@popperjs/core"
import bsCustomFileInput from 'bs-custom-file-input';
import './app.scss'
// start the Stimulus application
// import './bootstrap.js';


import { registerVueControllerComponents } from '@symfony/ux-vue';
registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));

// import { createApp } from './js/app'

// createApp().mount('#app')

// import { createApp } from 'vue';
// import App from './js/App.vue';
// import { MyVueElement } from './customElementsVue/testElement';


bsCustomFileInput.init();
