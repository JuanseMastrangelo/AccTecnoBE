require('./bootstrap');

window.Vue = require('vue');
import Vuelidate from 'vuelidate';
import Vue2Filters from 'vue2-filters';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('table-component', require('./components/Table.vue').default);
Vue.component('estadisticas-main-component', require('./components/Estadisticas/Main.vue').default);
Vue.component('cargar-productos-component', require('./components/Cargar/Productos.vue').default);
Vue.component('cargar-categorias-component', require('./components/Cargar/Categorias.vue').default);


 
Vue.use(Vue2Filters)
Vue.use(Vuelidate)
const app = new Vue({
    el: '#app',
});
