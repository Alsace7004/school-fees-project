<template>
    <div class="wrapper">
        <Nav/>
        <Aside/>
        <!--le contenu sera ici-->
        <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <Title titre="Scolarités" description="Payement des scolarités des étudiants"/>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->
                            <div class="container">
                                <div class="row mb-3">
                                            <div class="col-md-3">
                                                <select v-model="ret.valfil" v-on:change="onFilCycAnSuChange()"  id="code_filiere" class="form-control">
                                                    <option value="0" selected>Selectionner une Filiere</option>
                                                    <option  v-for="dFiliere in dFilieres" :key="dFiliere.code_filiere" :value="dFiliere.code_filiere" >{{dFiliere.code_filiere}}</option>
                                                </select>
                                            </div> 
                                            <div class="col-md-3">
                                                <select  v-model="ret.valcyc" @change="onFilCycAnSuChange()" id="cycle_id" class="form-control">
                                                    <option value="0" selected>Selectionner un cycle</option>
                                                    <option v-for="cycle in cycles" :key="cycle.libelle_cycle" :value="cycle.libelle_cycle" >{{cycle.libelle_cycle}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select  v-model="ret.valAnn" @change="onFilCycAnSuChange()"  id="year_id" class="form-control">
                                                    <option value="0" selected>Selectionner une Année</option>
                                                    <option v-for="year in years" :key="year.valeur_annee_scolaire" :value="year.valeur_annee_scolaire" >{{year.valeur_annee_scolaire}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select v-model="ret.valSuc" @change="onFilCycAnSuChange()" id="succursale_id" class="form-control">
                                                    <option value="0" selected>Selectionner une Succursale</option>
                                                    <option v-for="dSuccursale in dSuccursales" :key="dSuccursale.libelle_succursale" :value="dSuccursale.libelle_succursale">{{dSuccursale.libelle_succursale}}</option>
                                                </select>
                                            </div>
                                </div>

                                <div class="row mt-2" >
                                            
                                    <!---->
                                            <!--<div style="display: flex;justify-content: end;">
                                                <button class="btn-add"  @click="newModal" data-toggle="modal" data-target="#addNew">Ajouter</button>
                                            </div>-->
                                            <!--table-->
                                            <div class="tbl-header">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <!--<th>Matricule</th>-->
                                                            <th>Nom</th>
                                                            <th>Prenom</th>
                                                            <th>Gender</th>
                                                            <!--<th>Filiere</th>-->
                                                            <th>Succursale</th>
                                                            <th>Fil/Cyc/Ann</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tbl-content">
                                                <table>
                                                    <tbody>
                                                        <tr v-if="!etudiants.length" class="text-center" style="font-weight:bold;margin:0px auto">Pas d'étudiants trouvé</tr>
                                                        <tr v-for="(etudiant,i) in etudiants" :key="etudiant.id">
                                                            <td>{{i=i+1}}</td>
                                                            <!--<td>{{etudiant.matricule}}</td>-->
                                                            <td>{{etudiant.nom}}</td>
                                                            <td>{{etudiant.prenom}}</td>
                                                            <td>{{etudiant.genre}}</td>
                                                            <!--<td>{{etudiant.code_filiere}}</td>-->
                                                            <td>{{etudiant.libelle_succursale}}</td>
                                                            <td>{{etudiant.valeur_filiere}}</td>
                                                            <td>
                                                                <div class="display-flex">
                                                                    <a @click="payerScolarite(etudiant.id)" data-toggle="modal" data-target="#addNewPay" class="btn-edit">Pay</a>
                                                                    <a data-toggle="modal" data-target="#printNew" class="btn-edit">Print</a>
                                                                    <!--<a href="" class="btn-delete">Delete</a>-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--table-->
                                    <!---->
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="addNewPay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{is_Editing ?"Mise à jour d'un payement de Scolarité":"Effectuer un payement de Scolarité"}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form @submit.prevent="is_Editing ? updateEtudiant() : createEtudiant()">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Nom : {{scolarite.nom}}</label>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Prenom : {{scolarite.prenom}}</label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Filiere : {{scolarite.filiere}}</label>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Cycle : {{scolarite.cycle}}</label>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <p><label for="">Total à Payer : {{scolarite.scolarite}}</label></p>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Année Scolaire : {{scolarite.annee}}</label>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Total Payer à ce jour: {{scolarite.mt_payer}} FCFA</label>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Reste à Payer : {{scolarite.scolarite-scolarite.mt_payer}} FCFA</label>
                                                        </div>
                                                    </div>
                                                  
                                                  
                                                   
                                                    
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Somme à payer</label>
                                                            <input type="number" v-model="etudiant.montant_paye" id="montant" placeholder="date" class="form-control">
                                                        </div>
                                                    </div>
                                                
                                                
                                                    
                                                    
                                                </div>
                                            
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">{{is_Editing ?"Mette à jour":"Payer"}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="printNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Recu de paiement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                                   <div>
                                                    <!---->
                                                        <div class="header">
                                                            <div class="shool-info">
                                                                <p>le logo de l'ecole ici</p>
                                                            </div>
                                                        </div>
                                                    <!---->
                                                        <div class="title">
                                                                <p class="text-center" style="font-weight:bolder;letter-spacing:0.5rem">RECU DE PAIEMENT</p>
                                                                <p class="text-center"><strong>N° : 20200107403028314</strong></p>
                                                        </div>
                                                    <!---->
                                                        <div class="student_info" style="display:flex;justify-content:space-between">
                                                            <div class="one">
                                                                <p><strong>Nom :</strong> ADEBOLA</p>
                                                                <p><strong>Prénom(s) :</strong> ADEBAYO</p>
                                                                <p><strong>Matricule :</strong> 201900003780AAVT</p>
                                                            </div>
                                                            <div class="two">
                                                                <p><strong>Année :</strong> 2019-2020</p>
                                                                <p><strong>Succursale :</strong> AVEDJI</p>
                                                                <p><strong>Date :</strong> 07-01-2020</p>
                                                            </div>
                                                        </div>
                                                    <!---->
                                                        <div class="niveau_filiere">
                                                            <p class="text-center" style="font-weight:bolder">LICENCE 1 / IRT - Informatique Réseaux Télécommunication</p>
                                                        </div>
                                                    <!---->
                                                        <div class="historique_payement">
                                                            <p class="text-center">HISTORIQUE PAIEMENT</p>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="card">
                                        
                                                                    <!-- /.card-header -->
                                                                    <div class="card-body table-responsive p-0">
                                                                        <div class="tbl-header">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Date Paiment</th>
                                                                                        <th>Montant Payer</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                        <table class="table table-hover text-nowrap">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>1-07-2022</td>
                                                                                    <td>55000</td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td>01-08-2022</td>
                                                                                    <td>85000</td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td>01-09-2022</td>
                                                                                    <td>90000</td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td>01-10-2022</td>
                                                                                    <td>95000</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                    </div>
                                                                    <!-- /.card -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!---->
                                                        <div class="rappel_payement">

                                                        </div>
                                                    <!---->
                                                   </div>
                                                    
                                            </div>
                                            
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Imprimer</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                            </div>
                            
                            <!-- Small boxes (Stat box) -->
                            
                            <!-- /.row (main row) -->
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
        <Footer/>
    
    </div>
</template>

<script>
    import Title from "./pages/Title.vue";
    import Nav from "./pages/Nav.vue";
    import Aside from "./pages/Aside.vue";
    import Footer from "./pages/Footer.vue";
    export default {
        name:"Etudiant",
        components:{
            Nav,Aside,Footer,Title
        },
        data(){
            return{
                years:[],
                cycles:[],
                dFilieres:[],
                dSuccursales:[],

                //succursales:[],
                //filieres:[],
        
                etudiants:[],
                etudiant:{
                    etudiants_id:'',
                    montant_paye:'',
                    annee_scolaires_id:''
                },
                edit_id:'',
                is_Editing:false,
                 ret:{
                    valfil:"0",
                    valAnn:"0",
                    valcyc:"0",
                    valSuc:"0",
                },
                scolarite:{
                    nom:"",
                    prenom:"",
                    cycle:"",
                    filiere:"",
                    scolarite:"",
                    annee:"",
                    mt_payer:""
                }
            }
        },
        methods:{
            newModal(){
                this.etudiant={
                    nom:'',
                    prenom:'',
                    email:'',
                    genre:'',
                    date_anniv:'',
                    contact_1:'',
                    contact_2:'',
                    adresse:'',
                    nationalite:'',
                    matricule:'NPGNAF',
                    filiere_id:'',
                    year_id:'',
                    succursale_id:'',
                    montant:'50000'
                }
                this.is_Editing = false;
                $('#addNew').modal('show');
            },
            /*************************************************************/
               onFilCycAnSuChange(){
                            axios.get(`api/loadOnFilCycAnSuChange/${this.ret.valfil}/${this.ret.valcyc}/${this.ret.valAnn}/${this.ret.valSuc}`).then(res=>{
                                this.etudiants=res.data
                            })           
                },
            /************************LES-SELECT***************************/
            loadDistinctSuccursales(){
                axios.get('api/distincSuccursales').then((succursales)=>{
                    this.dSuccursales = succursales.data;
                })
            },
            loadDistinctFilieres(){
                axios.get('api/distinctFilieres').then((filieres)=>{
                    this.dFilieres = filieres.data;
                })
            },
            loadYears(){
                axios.get('api/years').then((data)=>{
                    this.years = data.data;
                })
            },
            loadCycles(){
                axios.get('api/cycles').then((cycles)=>{
                    this.cycles = cycles.data;
                })
            },
            /***********************************************************/
            /*loadDistinctFiliereCycleYear(){
                axios.get('api/filiereCycleYear').then((filieres)=>{
                    this.filieres = filieres.data;
                })
            },*/
            /*loadSuccursales(){
                axios.get('api/succursales').then((succursales)=>{
                    this.succursales = succursales.data;
                })
            },*/
            loadEtudiants(){
                axios.get('api/etudiants').then((etudiants)=>{
                    this.etudiants = etudiants.data;
                })
            },
           
            createEtudiant(){
                let nm = document.querySelector("#montant").value;
              
                if(nm ==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }
                axios.post("api/payerScolariteEtudiant",this.etudiant).then(()=>{
                    Swal.fire('Effectué!','Payement de Scolarité effectuer avec success.','success') ;
                    this.loadEtudiants();
                    this.etudiant={
                        etudiants_id:'',
                        montant_paye:'',
                        annee_scolaires_id:''
                    }
                    //$('#addNewPay').modal('hide');
                }).catch((err)=>{
                    //alert("err")
                    //console.log("err:",err.response.data.err.nom)
                    Swal.fire('Error !!!','Une erreure lors du payement de Scolarité de l\' etudiant !!!','error')
                    return;
                    
                })
            },

            payerScolarite(id){
                axios.get('api/getEtudiantScolariteInformation/'+id).then((res)=>{
                    console.log("valeur de res dans payerScolarite:",res.data);
                    this.scolarite.nom=res.data.etudiant[0].nom,
                    this.scolarite.prenom=res.data.etudiant[0].prenom,
                    this.scolarite.cycle=res.data.etudiant[0].code_cycle,
                    this.scolarite.filiere=res.data.etudiant[0].code_filiere,
                    this.scolarite.scolarite=res.data.etudiant[0].scolarite_filiere,
                    this.scolarite.annee=res.data.etudiant[0].valeur_annee_scolaire,
                    //this.scolarite.mt_payer=res.data.mt[0].montant_payer,
                    res.data.mt[0].montant_payer == null ? this.scolarite.mt_payer = 0 :this.scolarite.mt_payer=res.data.mt[0].montant_payer,
                    this.etudiant.etudiants_id=res.data.etudiant[0].id,
                    this.etudiant.annee_scolaires_id=res.data.etudiant[0].year_id
         
                })
            }
          
        },
        created(){
            //this.loadDistinctFiliereCycleYear();
            //this.loadSuccursales();
            this.loadEtudiants();
            
            /*SELECT*/
            this.loadDistinctFilieres();
            this.loadCycles();
            this.loadYears();
            this.loadDistinctSuccursales();
        },
        mounted() {
            var etudiant = document.querySelector('.scolarite');
            var dash = document.querySelector('.dash');
            dash.classList.remove('active');
            etudiant.classList.add('active');
        }
    }
</script>

<style scoped>

/***********************USERS-TABLE***********BEGIN*******************/
table{
    width: 100%;
    table-layout: fixed;
}
.tbl-header{
    /*background-color: rgba(255,255,255,0.3);*/
    background-color: gray;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.tbl-content{
    height: 300px;
    overflow-x: auto;
    margin-top: 0px;
    /*border: 1px solid rgba(255,255,255,0.3);*/
    border: 1px solid gray;
    color: #fff;
    background: -webkit-linear-gradient(left, #25c481, #25b7c4);
    background: linear-gradient(to right, #25c481, #25b7c4);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
th{
    padding: 20px 15px;
    text-align: left;
    font-weight: 900;
    font-size: 12px;
    color: #fff;
    text-transform: uppercase;
}
td{
    padding: 15px 15px;
    text-align: left;
    vertical-align: middle;
    font-weight: bolder;
    font-size: 12px;
    /*border-bottom: solid 1px rgba(255,255,255,0.1);*/
    border-bottom: solid 1px rgba(255,255,255,0.1);
}
/***********************USERS-TABLE***********END*******************/
/***********************BTN-DESIGN***BEGIN**************************/
.display-flex{
    display: flex;
    flex-direction: row;
    justify-content:space-between;
}
.btn-edit{
    border: none;
    background-color: blue;
    padding: 0.4rem 1rem;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    margin: 2px;
}
.btn-edit:hover{
    background-color:rgb(69, 69, 240);
    transition: 0.5s all;
    cursor: pointer;
}
.btn-delete{
    border: none;
    background-color: red;
    padding: 0.4rem 1rem;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    margin: 2px;
}
.btn-delete:hover{
    background-color:rgb(247, 82, 82);
    transition: 0.5s all;
}
.btn-add{
    border: none;
    background-color: blue; 
    padding: 0.4rem 1rem;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    margin: 2px;
    cursor: pointer;
    margin-bottom: 10px;
    font-weight: bolder;
}
/***********************BTN-DESIGN***END****************************/
</style>
