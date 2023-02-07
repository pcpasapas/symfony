// import { defineCustomElement } from 'vue'

import index from './customElements/index'
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import * as bootstrap from 'bootstrap'
import * as Popper from "@popperjs/core"
import bsCustomFileInput from 'bs-custom-file-input';

// start the Stimulus application
import './bootstrap';


import { registerVueControllerComponents } from '@symfony/ux-vue';
registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));

// import { createApp } from 'vue';
// import App from './js/App.vue';
// createApp(App).mount('#app');

bsCustomFileInput.init();
