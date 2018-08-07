import Vue from 'vue'
import axios from 'axios'
import App from './app.vue'

Vue.prototype.$axios = axios;
let vm = new Vue({
  el: '#app',
  render:h=>h(App)
})
Vue.use({vm})
