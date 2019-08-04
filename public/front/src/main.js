/* eslint-disable */
import Vue from 'vue'
import App from '@/App.vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import Toasted from 'vue-toasted';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '@/style.css';
import config from '@/config'
import About from '@/pages/About';
import Home from '@/pages/Home';
import Messages from '@/pages/MessageList';
import axios from 'axios';
window.$axios = axios.create({
    headers: {
        common: {        // can be common or any other method
            accept: 'application/json'
        }
    }
})



Vue.use(BootstrapVue);
Vue.use(Toasted);
Vue.use(VueRouter);
Vue.config.productionTip = false;

const routes = [
    {path: '/', component: Home},
    {path: '/about', component: About},
    {path: '/messages', component: Messages}
];

const router = new VueRouter({
    routes // short for `routes: routes`
});
// options to the toast
let options_error = {
    type: 'error',
    duration: 2000,
    singleton: true
};
let options_done = {
    type: 'success',
    duration: 2000,
    singleton: true
};

// register the toast with the custom message
Vue.toasted.register('my_app_error',
    (payload) => {

        // if there is no message passed show default message
        if (!payload.message) {
            return "Oops.. Something Went Wrong.."
        }

        // if there is a message show it with the message
        return "Oops.. " + payload.message;
    },
    options_error
);
Vue.toasted.register('my_app_done',
    (payload) => {

        // if there is no message passed show default message
        if (!payload.message) {
            return "YES!!.. Ok.."
        }

        // if there is a message show it with the message
        return "YES!!.. " + payload.message;
    },
    options_done
);
// new Vue({
//     el: '#app',
//     // router,
//     components: { App }
// })
// new Vue({
//     router,
// }).$mount('#app');
new Vue({
    router,
    data: {
        baseUrl: config.clinet_base,
    },
    render: h => h(App),
    components: {App},
    template: '<App/>'
}).$mount('#app');
