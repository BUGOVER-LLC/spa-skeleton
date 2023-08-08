/** @format */

// Import
import Vue from 'vue';
import App from './App.vue';
import i18n from './locales';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import VueMeta from 'vue-meta';

// Register layouts
Vue.component('AuthLayout', () => import('./layouts/auth.vue'));
Vue.component('GreetingLayout', () => import('./layouts/greeting.vue'));
Vue.component('AdminLayout', () => import('./layouts/admin.vue'));

// Config
Vue.config.productionTip = false;
Vue.prototype.$backendUrl = process.env.VUE_APP_BACKEND_URL;
Vue.prototype.$appName = process.env.VUE_APP_NAME;
Vue.use(VueMeta);

// Start Vue Js Instance
new Vue({
    el: '#app',
    router,
    i18n,
    store,
    vuetify,
    render: h => h(App),
}).$mount('#app');
