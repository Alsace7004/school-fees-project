/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
/*****************************************/
// ES6 Modules or TypeScript
import Swal from 'sweetalert2';
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast  = Toast ;

/*****************************************/
import Form from 'vform';
window.Form = Form;
/*****************************************/
/*vue component config*/
import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
    {path:'/',component:require('./components/Try.vue').default},
    {path:'/etudiants',component:require('./components/Etudiant.vue').default},
    {path:'/filieres',component:require('./components/Filiere.vue').default},
    {path:'/succursales',component:require('./components/Succursale.vue').default},
    {path:'/users',component:require('./components/User.vue').default},
    {path:'/villes',component:require('./components/Ville.vue').default},
    {path:'/years',component:require('./components/Year.vue').default},
    {path:'/cycles',component:require('./components/Cycle.vue').default},
    {path:'/scolarites',component:require('./components/Scolarite.vue').default}
]

const router = new VueRouter({
    routes
})
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
