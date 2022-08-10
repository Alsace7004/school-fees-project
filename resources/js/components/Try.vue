<template>
    <div class="wrapper">
        <Nav/>
        <Aside/>
        <!--le contenu sera ici-->
        <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->
                            <div class="row mt-3">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{users}}</h3>
                                        <p>Utilisateurs</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <router-link to="/users" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{etudiants}}</h3>

                                        <p>Etudiants</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <router-link to="/etudiants" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{filieres}}</h3>

                                        <p>Filieres</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <router-link to="/filieres" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{cycles}}</h3>

                                        <p>Cycles</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <router-link to="/cycles" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{villes}}</h3>
                                        <p>Villes</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <router-link to="/villes" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{succursales}}</h3>
                                        <!--<sup style="font-size: 20px">%</sup>-->
                                        <p>Succursales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <router-link to="/succursales" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{years}}</h3>

                                        <p>Années Scolaires</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <router-link to="/years" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{cycles}}</h3>

                                        <p>Cycles</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <router-link to="#" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- Small boxes (Stat box) -->
                            <div class="row mt-5">
                                <router-view></router-view>
                            </div>
                            <!-- /.row (main row) -->
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
        <Footer/>
    
    </div>
</template>

<script>
import Title from "../components/pages/Title.vue";
import Nav from "../components/pages/Nav.vue";
import Aside from "../components/pages/Aside.vue";
import Footer from "../components/pages/Footer.vue";
export default {
  name: "Try",
  props: {
    msg: String,
  },
  components:{
    Nav,Aside,Footer,Title
  },
  data(){
    return{
        users:'',
        etudiants:'',
        filieres:'',
        cycles:'',
        villes:'',
        succursales:'',
        years:'',
    }
  },
  methods:{
    loadCountData(){
        axios.get('api/count').then((res)=>{
            //console.log("valeur de res pour le count: ",res.data)
            this.users = res.data.users[0].nbr_users;
            this.etudiants = res.data.etudiants[0].nbr_etudiants;
            this.filieres = res.data.filieres[0].nbr_filieres;
            this.cycles = res.data.cycles[0].nbr_cycles;
            this.villes = res.data.villes[0].nbr_villes;
            this.succursales = res.data.succursales[0].nbr_succursales;
            this.years = res.data.years[0].nbr_years;
            
        })
    }
  },
  created(){
    this.loadCountData();
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>
