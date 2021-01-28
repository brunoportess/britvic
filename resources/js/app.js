require('./bootstrap');

require('alpinejs');

window.Vue = require('vue').default;

Vue.component('custom-table', require('./components/CustomTable.vue').default);
Vue.component('lista-veiculos', require('./components/ListaVeiculos.vue').default);
Vue.component('lista-usuarios', require('./components/ListaUsuarios.vue').default);
Vue.component('lista-reservas', require('./components/ListaReservas.vue').default);
Vue.component('reservas-formulario', require('./components/ReservaFormulario.vue').default);
Vue.component('relatorio', require('./components/RelatorioReservaVeiculo.vue').default);

const app = new Vue({
    el: '#app',
});
