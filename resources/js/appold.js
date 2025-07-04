
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Chart = require('chart.js');
require('fullcalendar');

window.Vue = require('vue'); 

window.moment = require('moment');
require('moment/locale/es')

window.Toastr = require('toastr');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fas)

Vue.component('font-awesome-icon', FontAwesomeIcon)

import { VueEditor } from "vue2-editor";
Vue.use(VueEditor);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('invitado-new-component', require('./components/invitados/nuevoInvitado.vue').default);
Vue.component('invitado-tarjetas-component', require('./components/invitados/tarjetas.vue').default);
Vue.component('invitado-component', require('./components/invitados/invitado.vue').default);

Vue.component('manifiesto-component', require('./components/invitados/manifiesto.vue').default);


Vue.component('sede-component', require('./components/sistema/sede.vue').default);
Vue.component('sedes-component', require('./components/sistema/sedes.vue').default);


Vue.component('bonos-component', require('./components/sistema/bonos.vue').default);
Vue.component('bono-component', require('./components/sistema/bono.vue').default);
Vue.component('enunciados-component', require('./components/sistema/enunciados.vue').default);
Vue.component('enunciado-component', require('./components/sistema/enunciado.vue').default);


Vue.component('servicios-component', require('./components/sistema/servicios.vue').default);
Vue.component('servicio-component', require('./components/sistema/servicio.vue').default);


Vue.component('variables-component', require('./components/sistema/variables.vue').default);
Vue.component('variable-component', require('./components/sistema/variable.vue').default);


Vue.component('productos-component', require('./components/sistema/productos.vue').default);
Vue.component('producto-component', require('./components/sistema/producto.vue').default);
Vue.component('proveedores-component', require('./components/sistema/proveedores.vue').default);
Vue.component('proveedor-component', require('./components/sistema/proveedor.vue').default);


Vue.component('registrotmk-component', require('./components/sistema/registrotmk.vue').default);


Vue.component('cargos-component', require('./components/empleados/cargos.vue').default);
Vue.component('cargo-component', require('./components/empleados/cargo.vue').default);

Vue.component('empleados-component', require('./components/empleados/empleados.vue').default);
Vue.component('empleado-component', require('./components/empleados/empleado.vue').default);


Vue.component('contrato-nuevo-component', require('./components/contratos/contratoNuevo.vue').default);
Vue.component('contrato-component', require('./components/contratos/contrato.vue').default);
Vue.component('contratos-component', require('./components/contratos/contratos.vue').default);
Vue.component('cartera-component', require('./components/contratos/cartera.vue').default);

Vue.component('nominas-component', require('./components/contratos/nominas.vue').default);
Vue.component('nomina-component', require('./components/contratos/nomina.vue').default);

Vue.component('tikets-component', require('./components/afiliado/tikets.vue').default);
Vue.component('tiket-component', require('./components/afiliado/tiket.vue').default);
Vue.component('afiliado-component', require('./components/afiliado/afiliado.vue').default);
Vue.component('foros-component', require('./components/afiliado/foros.vue').default);
Vue.component('foro-component', require('./components/afiliado/foro.vue').default);
Vue.component('productos-afiliado-component', require('./components/afiliado/productos.vue').default);
Vue.component('producto-afiliado-component', require('./components/afiliado/producto.vue').default);
Vue.component('servicios-afiliado-component', require('./components/afiliado/misservicios.vue').default);

Vue.component('usuarios-component', require('./components/usuarios/usuarios.vue').default);
Vue.component('usuario-component', require('./components/usuarios/usuario.vue').default);
Vue.component('roles-component', require('./components/usuarios/roles.vue').default);
Vue.component('rol-component', require('./components/usuarios/rol.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
