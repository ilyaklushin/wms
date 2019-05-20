import Vue from 'vue'
import Vuetify from 'vuetify'
import ExchangeHistory from '@/js/views/ExchangeHistory'
import ExchangeSettings from '@/js/views/ExchangeSettings'
import 'vuetify/dist/vuetify.min.css'
import 'vue-material-design-icons/styles.css'


Vue.use(Vuetify);

//var App = ExchangeSettings

var App = ExchangeHistory

const app = new Vue({
	el: '#app',
	render: h => h(App),
});

export default app;