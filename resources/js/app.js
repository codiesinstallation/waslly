require("./bootstrap");
require("lang.js");

import Vue from "vue";
import VueRouter from "vue-router";
import VueHtmlToPaper from "./Helpers/vueHtmlToPaper";

import { routes } from "./routes";
//Multi lang
import { Lang } from "laravel-vue-lang";
import Cookie from "./Helpers/Cookie";
window.Cookie = Cookie;

Vue.use(Lang, {
    locale: location.pathname.split('/')[1],
    fallback: "ar",
});
import VueQuagga from "vue-quaggajs";
Vue.prototype.$url = window.location.origin;

// register component 'v-quagga'
Vue.use(VueQuagga);
Vue.use(VueRouter);
let bootstrap =
    window.location.origin + "/assets/css/bootstrap.rtl.min.css";
let style = window.location.origin + "/css/print.css";
Vue.use(VueRouter);
const options = {
    name: "_blank",
    specs: ["fullscreen=yes", "titlebar=yes", "scrollbars=yes"],
    styles: [bootstrap, style],
};
Vue.use(VueHtmlToPaper, options);

// Import User Class
import User from "./Helpers/User";

window.User = User;
//Notification
import Notification from "./Helpers/Notification";
import JsPrintApp from "./Helpers/JsPrint";
import vueHtmlToPaper from "./Helpers/vueHtmlToPaper";
window.JsPrintApp = JsPrintApp;

window.Notification = Notification;

//end sweet alert
const router = new VueRouter({
    routes,
    mode: "history", // short for `routes: routes`
});
window.Reload = new Vue();
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('order-component', require('./components/Orders/index.vue').default);
Vue.component('country-component', require('./components/country/index.vue').default);
Vue.component('governorate-component', require('./components/governorate/index.vue').default);
Vue.component('list-component', require('./components/Orders/list.vue').default);
Vue.component('settings-component', require('./components/branches/edit.vue').default);
Vue.component('follow-component', require('./components/Orders/follow.vue').default);
Vue.component('print-component', require('./components/Orders/printer.vue').default);
Vue.component('users-component', require('./components/users/index.vue').default);
Vue.component('expenses-component', require('./components/expenses/index.vue').default);

const app = new Vue({


    el: "#app",
    router,
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */