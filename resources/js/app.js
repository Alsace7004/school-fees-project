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
    {path:'/login',component:require('./components/Login.vue').default},
    {path:'/register',component:require('./components/Register.vue').default},
    {
      path:'/',
      component:require('./components/Try.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:true,
        caissier:true,
      }
    },
    {
      path:'/etudiants',
      component:require('./components/Etudiant.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:false,
        caissier:true,
      }
    },
    {
      path:'/filieres',
      component:require('./components/Filiere.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:true,
        caissier:false,
      }
    },
    {
      path:'/succursales',
      component:require('./components/Succursale.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:true,
        caissier:false,
      }
    },
    {
      path:'/users',
      component:require('./components/User.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:false,
        caissier:false,
      }
    },
    {
      path:'/villes',
      component:require('./components/Ville.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:true,
        caissier:false,
      }
    },
    {
      path:'/years',
      component:require('./components/Year.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:true,
        caissier:false,
      }
    },
    {
      path:'/cycles',
      component:require('./components/Cycle.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        secretaire:true,
        caissier:false,
      }
    },
    {
      path:'/scolarites',
      component:require('./components/Scolarite.vue').default,
      meta:{
        requiresAuth:true,
        admin:true,
        caissier:true,
        secretaire:false,
      }
    }
]

const router = new VueRouter({
    routes
})

/*router.beforeEach((to,from,next)=>{
  if(to.matched.some(record=>record.meta.requiresAuth)){
    if(localStorage.getItem("jwt")==null){
      next({path:'/login'});
    }else{
      next();
    }
  }else{
    next();
  }
})*/
router.beforeEach((to,from,next)=>{
  if(to.matched.some(record=>record.meta.requiresAuth)){
    if(localStorage.getItem("jwt")==null){
      next({path:'/login'});
    }else if((to.meta.admin) && (to.meta.secretaire) && (to.meta.caissier)){
      const authUserRole        = (window.localStorage.getItem("role"));
      const authSecretaireRole  = (window.localStorage.getItem("role"));
      const authCaissierRole    = (window.localStorage.getItem("role"));
      //console.log("valeur de authUserRole :",authUserRole);
      if(authUserRole =="Admin" || authSecretaireRole =="Secretaire" || authCaissierRole =="Caissier"){
        next();
      }else{
        //alert("Allez Ouss,dehors caissier ,secretaire et admin");
        next({path:'/login'});
      }
    }else if((to.meta.admin) && (to.meta.secretaire)){
      const authUserRole        = (window.localStorage.getItem("role"));
      const authSecretaireRole  = (window.localStorage.getItem("role"));
      //console.log("valeur de authUserRole :",authUserRole);
      if(authUserRole =="Admin" || authSecretaireRole =="Secretaire"){
        next();
      }else{
        //alert("Allez Ouss,dehors secretaire et admin");
        next({path:'/login'});
      }
    }else if((to.meta.admin) && (to.meta.caissier)){
      const authUserRole        = (window.localStorage.getItem("role"));
      const authCaissierRole    = (window.localStorage.getItem("role"));
      //console.log("valeur de authUserRole :",authUserRole);
      if(authUserRole =="Admin" || authCaissierRole =="Caissier"){
        next();
      }else{
        //alert("Allez Ouss,dehors caissier et admin");
        next({path:'/login'});
      }
    }else if(to.meta.admin){
      const authUserRole = (window.localStorage.getItem("role"));
      //console.log("valeur de authUserRole :",authUserRole);
      if(authUserRole =="Admin"){
        next();
      }else{
        //alert("Allez Ouss,dehors admin");
        next({path:'/login'});
      }
    }else if(to.meta.secretaire){
      const authSecretaireRole = (window.localStorage.getItem("role"));
      //console.log("valeur de authUserRole :",authUserRole);
      if(authSecretaireRole =="Secretaire"){
        next();
      }else{
        //alert("Allez Ouss,dehors secretaire");
        next({path:'/login'});
      }
    }else if(to.meta.caissier){
      const authCaissierRole = (window.localStorage.getItem("role"));
      //console.log("valeur de authUserRole :",authUserRole);
      if(authCaissierRole =="Caissier"){
        next();
      }else{
        //alert("Allez Ouss,dehors caissier");
        next({path:'/login'});
      }
    }else{
      next();
    }
  }else{
    next();
  }
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

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
