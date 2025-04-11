import {App, defineAsyncComponent} from 'vue';

const LocationActions = defineAsyncComponent(() => import('./LocationActions.vue'));

export default {
    install(app: App) {
        app.component('LocationActions', LocationActions);
    },
};
