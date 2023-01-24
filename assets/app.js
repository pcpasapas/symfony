/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import * as bootstrap from 'bootstrap'
import * as Popper from "@popperjs/core"
import bsCustomFileInput from 'bs-custom-file-input';

import { registerVueControllerComponents } from '@symfony/ux-vue';
registerVueControllerComponents(require.context('./js', true, /\.vue$/));
// start the Stimulus application
import './bootstrap';

import { createApp } from 'vue';
import App from './js/App.vue';


createApp(App).mount('#app');

bsCustomFileInput.init();
