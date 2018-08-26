import Vue from 'vue'
import axios from 'axios'
import BootstrapVue from "bootstrap-vue"
import App from './App.vue'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap-vue/dist/bootstrap-vue.css"



Vue.use(BootstrapVue)
Vue.prototype.$axios = axios;
new Vue({
  el: '#app',
  render: h => h(App)
})