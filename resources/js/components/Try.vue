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
                            <!--first table begin-->
                            <!--<div class="row">
                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Nombre d'Etudiants par Succursales</h3>

                                                                <div class="card-tools">
                                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                                    <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-default">
                                                                        <i class="fas fa-search"></i>
                                                                    </button>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                     
                                                            <div class="card-body table-responsive p-0">
                                                                <table class="table table-hover text-nowrap">
                                                                <thead>
                                                                    <tr>
                                                                    <th>ID</th>
                                                                    <th>User</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                    <th>Reason</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                    <td>183</td>
                                                                    <td>John Doe</td>
                                                                    <td>11-7-2014</td>
                                                                    <td><span class="tag tag-success">Approved</span></td>
                                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>219</td>
                                                                    <td>Alexander Pierce</td>
                                                                    <td>11-7-2014</td>
                                                                    <td><span class="tag tag-warning">Pending</span></td>
                                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>657</td>
                                                                    <td>Bob Doe</td>
                                                                    <td>11-7-2014</td>
                                                                    <td><span class="tag tag-primary">Approved</span></td>
                                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>175</td>
                                                                    <td>Mike Doe</td>
                                                                    <td>11-7-2014</td>
                                                                    <td><span class="tag tag-danger">Denied</span></td>
                                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                          
                                                        </div>
                                      
                                    </div>
                            </div>-->
                            <!---->
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Le nombre d'etudiants par Succursales</h3>

                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <Pie
                                        :chart-options="chartOptions"
                                        :chart-data="chartData"
                                        :chart-id="chartId"
                                        :dataset-id-key="datasetIdKey"
                                        :plugins="plugins"
                                        :css-classes="cssClasses"
                                        :styles="styles"
                                        :width="width"
                                        :height="height"
                                    />
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!---->
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
//import Title from "../components/pages/Title.vue";
import Nav from "../components/pages/Nav.vue";
import Aside from "../components/pages/Aside.vue";
import Footer from "../components/pages/Footer.vue";

import { Pie } from 'vue-chartjs/legacy'

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)

export default {
  name: "Try",
  props: {
    msg: String,
  },
  components:{
    Nav,Aside,Footer,Title, Pie
  },
  props: {
    chartId: {
      type: String,
      default: 'pie-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Array,
      default: () => []
    }
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

        chartData: {
            //labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
            labels: [],
            datasets: [
                {
                    backgroundColor: ['#41B883', '#3498db', '#00D8FF', '#ffa502'],
                    //data: [40, 20, 80, 10]
                    data: []
                }
            ]
        },
        chartOptions: {
            responsive: true,
            maintainAspectRatio: false
        }
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
    },
    loadNbrEtudiantParSuccursale(){
        axios.get('api/etudiantParSuccursale').then((res)=>{
            //console.log("valeur de res lors des stats :",res.data)
            var k = res.data;
            for(var i =0;i<k.length;i++){
                //console.log("valeur des i:",k[i].libelle_succursale)
                //console.log("valeur des i:",k[i].nbr_etudiants)
                this.chartData.labels.push(k[i].libelle_succursale);
                this.chartData.datasets[0].data.push(k[i].nbr_etudiants);
            }
        })
    }
  },
  created(){
    this.loadCountData();
    this.loadNbrEtudiantParSuccursale();
  },
  mounted(){
    
  }

};
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>
