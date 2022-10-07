<template>
  <div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img :src="'../admin/dist/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fees-Bank</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img :src="'../admin/dist/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{user.email}} ({{user.user_role}})</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu salut -->
        <nav class="mt-2 ">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <router-link to="/" class="nav-link dash active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class="nav-header">UTILISATEURS</li>
            <li class="nav-item">
              <router-link to="/users" class="nav-link personnel">
                <i class="nav-icon fas fa-users"></i>
                <p>Personnels</p>
              </router-link>
            </li>
            
            <li class="nav-header">ETUDIANTS</li>
            <li class="nav-item">
              <router-link to="/etudiants" class="nav-link etudiant">
                <i class="nav-icon fas fa-users"></i>
                <p>Etudiants</p>
              </router-link>
            </li>
            <li class="nav-header">SCOLARITES</li>
            <li class="nav-item">
              <router-link to="/scolarites" class="nav-link scolarite">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>Scolarités</p>
              </router-link>
            </li>
            <li class="nav-header">FILIERES</li>
            <li class="nav-item">
              <router-link to="/filieres" class="nav-link filiere">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Filieres</p>
              </router-link>
            </li>

            

            <li class="nav-header">CYCLES</li>
            <li class="nav-item">
              <router-link to="/cycles" class="nav-link cycle">
                <i class="nav-icon fas fa-level-up-alt"></i>
                <p>Cycles</p>
              </router-link>
            </li>

            <li class="nav-header">VILLES</li>
            <li class="nav-item">
              <router-link to="/villes" class="nav-link ville">
                <i class="nav-icon fas fa-city"></i>
                <p>Villes</p>
              </router-link>
            </li>

   
            
            <li class="nav-header">SUCCURSALES</li>
            <li class="nav-item">
              <router-link to="/succursales" class="nav-link succursale">
                <i class="nav-icon fas fa-building"></i>
                <p>Succursales</p>
              </router-link>
            </li>

            <li class="nav-header">ANNEES SCOLAIRES</li>
            <li class="nav-item">
              <router-link to="/years" class="nav-link year">
                <i class="nav-icon fas fa-table"></i>
                <p>Années Scolaires</p>
              </router-link>
            </li>

            <li class="nav-header">PARAMETRES</li>
            <li class="nav-item" >
              <a @click="logoutUser" class="nav-link">
                <i class="nav-icon fas fa-power-off text-danger"></i>
                <p class="text">Logout</p>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</template>

<script>
  import axiosClient from "../../axios/index";
export default {
  name: "Aside",
  props: {
   
  },
  data(){
    return{
      user:{
        name:'',
        email:'',
        user_role:'',
      }
    }
  },
  methods:{
    loadAuthUser(){
      axiosClient.get('api/authUser').then((res)=>{
        //console.log("valeur de res dans auth user:",res)
        this.user.name = res.data.name;
        this.user.email = res.data.email;
        let rl = localStorage.getItem("role");
        //console.log("valeur du role:",rl)
        this.user.user_role = rl;
        
      })
    },
    logoutUser(){
      axiosClient.post('api/logout').then((res)=>{
        localStorage.clear();
        this.$router.push('/login');
      })
    }
  },
  created(){
    this.loadAuthUser();
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>
