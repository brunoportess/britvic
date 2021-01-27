require('./bootstrap');

require('alpinejs');

window.Vue = require('vue').default;

Vue.component('custom-table', require('./components/CustomTable.vue').default);
Vue.component('lista-veiculos', require('./components/ListaVeiculos.vue').default);

const app = new Vue({
    el: '#app',
});
