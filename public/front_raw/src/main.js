import Vue from 'vue'
import routes from './routes';
import config from './config'
import BootstrapVue from 'bootstrap-vue'
import Toasted from 'vue-toasted';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './style.css';
Vue.use(BootstrapVue);
Vue.use(Toasted);

// options to the toast
let options_error = {
    type : 'error',
    duration:2000,
    singleton:true
};
let options_done = {
    type : 'success',
    duration:2000,
    singleton:true
};

// register the toast with the custom message
Vue.toasted.register('my_app_error',
    (payload) => {

        // if there is no message passed show default message
        if(! payload.message) {
            return "Oops.. Something Went Wrong.."
        }

        // if there is a message show it with the message
        return "Oops.. " + payload.message;
    },
    options_error
)
Vue.toasted.register('my_app_done',
    (payload) => {

        // if there is no message passed show default message
        if(! payload.message) {
            return "YES!!.. Ok.."
        }

        // if there is a message show it with the message
        return "YES!!.. " + payload.message;
    },
    options_done
)
const app = new Vue({
    el: '#app',
    data: {
        currentRoute: window.location.pathname,
        baseUrl:config.clinet_base,
    },
    computed: {
        ViewComponent () {
            this.currentRoute=this.currentRoute.replace(this.baseUrl,"/");
            const matchingView = routes[this.currentRoute];
            return matchingView
                ? require('./pages/' + matchingView + '.vue')
                : require('./pages/404.vue')
        }
    },
    render (h) {
        return h(this.ViewComponent)
    }
})

window.addEventListener('popstate', () => {
    app.currentRoute = window.location.pathname
})