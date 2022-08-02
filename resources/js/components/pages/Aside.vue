<template>
  <div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img :src="'../admin/dist/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img :src="'../admin/dist/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Ogunbissi Moshe</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Rechercher..." aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">USERS</li>
            <li class="nav-item">
              <router-link to="/users" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Users
                  <span class="right badge badge-danger">New</span>
                </p>
              </router-link>
            </li>
            
            <li class="nav-header">ETUDIANTS</li>
            <li class="nav-item">
              <router-link to="/etudiants" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Etudiants<span class="badge badge-info right">6</span></p>
              </router-link>
            </li>

            <li class="nav-header">FILIERES</li>
            <li class="nav-item">
              <router-link to="/filieres" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Filieres</p>
              </router-link>
            </li>

            <li class="nav-header">CYCLES</li>
            <li class="nav-item">
              <router-link to="/cycles" class="nav-link">
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>Cycles</p>
              </router-link>
            </li>

            <li class="nav-header">VILLES</li>
            <li class="nav-item">
              <router-link to="/villes" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Villes
                  <span class="badge badge-info right">2</span>
                </p>
              </router-link>
            </li>

   
            
            <li class="nav-header">SUCCURSALES</li>
            <li class="nav-item">
              <router-link to="/succursales" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>Succursales</p>
              </router-link>
            </li>

            <li class="nav-header">ANNEES SCOLAIRES</li>
            <li class="nav-item">
              <router-link to="/years" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Années Scolaires</p>
              </router-link>
            </li>

            <li class="nav-header">PARAMETRES</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
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
export default {
  name: "Aside",
  props: {
    
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>
