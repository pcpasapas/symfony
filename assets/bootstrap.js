import { startStimulusApp } from '@symfony/stimulus-bridge';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./vue/controllers',
    true,
    /\.[jt]sx?$/
));

// import cardComposant from './vue/controllers/cardComposant.vue'
// register any custom, 3rd party controllers here
// app.register('cardComposant', cardComposant);
