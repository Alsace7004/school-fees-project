<template>
    <div class="container">
        <div class="row">
                    <div class="col-md-3">
                        <select id="code_filiere" class="form-control">
                            <option value="" hidden selected>Selectionner une Filiere</option>
                        </select>
                    </div> 
                    <div class="col-md-3">
                        <select id="cycle_id" class="form-control">
                            <option value="" hidden selected>Selectionner un cycle</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="year_id" class="form-control">
                            <option value="" hidden selected>Selectionner une Année</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="year_id" class="form-control">
                            <option value="" hidden selected>Selectionner une Succursale</option>
                        </select>
                    </div>
        </div>

        <div class="row mt-5" >
                    
            <!---->
                    <div style="display: flex;justify-content: end;">
                        <button class="btn-add"  @click="newModal" data-toggle="modal" data-target="#addNew">Ajouter</button>
                    </div>
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
                                    <th>Filiere</th>
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
                                <tr v-for="(etudiant,i) in etudiants" :key="etudiant.id">
                                    <td>{{i=i+1}}</td>
                                    <!--<td>{{etudiant.matricule}}</td>-->
                                    <td>{{etudiant.nom}}</td>
                                    <td>{{etudiant.prenom}}</td>
                                    <td>{{etudiant.genre}}</td>
                                    <td>{{etudiant.code_filiere}}</td>
                                    <td>{{etudiant.libelle_succursale}}</td>
                                    <td>{{etudiant.valeur_filiere}}</td>
                                    <td>
                                        <div class="display-flex">
                                            <a href="" class="btn-edit">Pay</a>
                                            <a href="" class="btn-edit">Edit</a>
                                            <a href="" class="btn-delete">Delete</a>
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
        <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{is_Editing ?"Update Etudiant":"Add New Etudiant"}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="is_Editing ? updateEtudiant() : createEtudiant()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.nom"  id="nom" placeholder="Nom..." class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.prenom" id="prenom" placeholder="Prenom..." class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.email"  id="email" placeholder="Email..." class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="" v-model="etudiant.genre" class="form-control" id="genre">
                                        <option value="">Genre</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Feminin</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.contact_1" id="contact_1" placeholder="Contact 1..." class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.contact_2" id="contact_2" placeholder="Contact 2..." class="form-control">
                                </div>
                                
                            </div>
                             <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.adresse" id="adresse" placeholder="Adresse..." class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" v-model="etudiant.nationalite" id="nationalite" placeholder="Nationalite..." class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                            
                                    <input type="date" min='1990-01-01' max='2010-01-01' v-model="etudiant.date_anniv" id="date_anniv" placeholder="date" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                  
                                    <select name="" v-model="etudiant.succursale_id" class="form-control" id="succursale_id">
                                        <option value="" selected>Succursales</option>
                                        <option v-for="succursale in succursales" :key="succursale.id" :value="succursale.id">{{succursale.libelle_succursale}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Inscription</label>
                                    <input type="number" v-model="etudiant.montant" id="montant" placeholder="date" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Filieres</label>
                                    <select name="" v-model="etudiant.filiere_id" class="form-control" id="">
                                        <option value="">Filiere</option>
                                        <option v-for="filiere in filieres" :key="filiere.id" :value="filiere.id">{{filiere.valeur_filiere}}</option>
                                    </select>
                                </div>
                            </div>
                         
                            
                            
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{is_Editing ?"Update":"Create"}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
</template>

<script>
    export default {
        name:"Etudiant",
        data(){
            return{
                succursales:[],
                filieres:[],
            
              
                etudiants:[],
                etudiant:{
                    nom:'',
                    prenom:'',
                    email:'',
                    genre:'',
                    date_anniv:'',
                    contact_1:'',
                    contact_2:'',
                    adresse:'',
                    nationalite:'',
                    matricule:'',
                    filiere_id:'',
                    year_id:'',
                    succursale_id:'',
                    montant:'50000'
                },
                edit_id:'',
                is_Editing:false,
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
            loadDistinctFiliereCycleYear(){
                axios.get('api/filiereCycleYear').then((filieres)=>{
                    this.filieres = filieres.data;
                })
            },
            loadSuccursales(){
                axios.get('api/succursales').then((succursales)=>{
                    this.succursales = succursales.data;
                })
            },
            loadEtudiants(){
                axios.get('api/etudiants').then((etudiants)=>{
                    this.etudiants = etudiants.data;
                })
            },
            /*createEtudiant(){
                let nm = document.querySelector("#nom").value;
                let pr = document.querySelector("#prenom").value;
                if(nm =="" || pr==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }
                axios.post(`api/etudiant`,this.etudiant).then(()=>{
                    //$('#addNew').modal('hide');
                    Swal.fire('Created!','Etudiant créer avec success.','success') ;
                    this.loadEtudiants();
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
                        matricule:'',
                        filiere_id:'',
                        year_id:'',
                        succursale_id:'',
                        montant:'50000'
                    }
                }).catch((err)=>{
                    Swal.fire('Error !!!','An Error Occured !!!','error')
                })
            },*/
            createEtudiant(){
                let nm = document.querySelector("#nom").value;
                let pr = document.querySelector("#prenom").value;
                if(nm =="" || pr==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }
                axios.post("api/etudiants",this.etudiant).then(()=>{
                    Swal.fire('Created!','Etudiant créer avec success.','success') ;
                    this.loadEtudiants();
                }).catch((err)=>{
                    //alert("err")
                    //console.log("err:",err.response.data.err.nom)
                    if(err.response.data.err.nom){
                        Swal.fire('Error !!!',`${err.response.data.err.nom[0]}`,'error')
                        return;
                    }else if(err.response.data.err.prenom){
                        Swal.fire('Error !!!',`${err.response.data.err.prenom[0]}`,'error')
                        return;
                    }else if(err.response.data.err.email){
                        Swal.fire('Error !!!',`${err.response.data.err.email[0]}`,'error')
                        return;
                    }else if(err.response.data.err.genre){
                        Swal.fire('Error !!!',`${err.response.data.err.genre[0]}`,'error')
                        return;
                    }else if(err.response.data.err.date_anniv){
                        Swal.fire('Error !!!',`${err.response.data.err.date_anniv[0]}`,'error')
                        return;
                    }else if(err.response.data.err.contact_1){
                        Swal.fire('Error !!!',`${err.response.data.err.contact_1[0]}`,'error')
                        return;
                    }else if(err.response.data.err.nationalite){
                        Swal.fire('Error !!!',`${err.response.data.err.nationalite[0]}`,'error')
                        return;
                    }else if(err.response.data.err.adresse){
                        Swal.fire('Error !!!',`${err.response.data.err.adresse[0]}`,'error')
                        return;
                    }else if(err.response.data.err.filiere_id){
                        Swal.fire('Error !!!',`${err.response.data.err.filiere_id[0]}`,'error')
                        return;
                    }else if(err.response.data.err.succursale_id){
                        Swal.fire('Error !!!',`${err.response.data.err.succursale_id[0]}`,'error')
                        return;
                    }else if(err.response.data.err.montant){
                        Swal.fire('Error !!!',`${err.response.data.err.montant[0]}`,'error')
                        return;
                    }else{
                        Swal.fire('Error !!!','Une erreure lors de l\'ajout d\'un etudiant !!!','error')
                        return;
                    }
                })
            }
          
        },
        created(){
            this.loadDistinctFiliereCycleYear();
            this.loadSuccursales();
            this.loadEtudiants();
        },
        /*mounted() {
            console.log('Component mounted.')
        }*/
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
