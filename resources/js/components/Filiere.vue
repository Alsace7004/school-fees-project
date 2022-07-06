<template>
    <div class="container">
        <div class="row mt-5" >
            <!---->
                <div class="col-md-4">
                    <select v-model="ret.valfil" v-on:change="onFiliereChange()"  id="code_filiere" class="form-control">
                        <option value="0" selected>Selectionner une Filiere</option>
                        <option  v-for="dFiliere in dFilieres" :key="dFiliere.code_filiere" :value="dFiliere.code_filiere" >{{dFiliere.code_filiere}}</option>
                    </select>
                </div> 
                <div class="col-md-4">
                    <select  v-model="ret.valAnn" @change="onFiliereChange()"  id="year_id" class="form-control">
                        <option value="0" selected>Selectionner une Année</option>
                        <option v-for="year in years" :key="year.valeur_annee_scolaire" :value="year.valeur_annee_scolaire" >{{year.valeur_annee_scolaire}}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select  v-model="ret.valcyc" @change="onFiliereChange()" id="cycle_id" class="form-control">
                        <option value="0" selected>Selectionner un cycle</option>
                        <option v-for="cycle in cycles" :key="cycle.libelle_cycle" :value="cycle.libelle_cycle" >{{cycle.libelle_cycle}}</option>
                    </select>
                </div>
                    
                    
                <div style="display: flex;justify-content: end;" class="mt-2">
                    <button class="btn-add" @click="newModal"  data-toggle="modal" data-target="#addNew">Ajouter</button>
                </div>
            
                    
                    <!--table-->
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Code Filiere</th>
                                    <th>Nom Filiere</th>
                                    <th>Scolarite Filiere</th>
                                    <th>Année Scolaire</th>
                                    <th>Cycle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table>
                            <tbody>
                                <tr v-if="!filieres.length" class="text-center" style="font-weight:bold;margin:0px auto">No filieres found</tr>
                                <tr v-for="filiere in filieres" :key="filiere.id">
                                    <td>{{filiere.id}}</td>
                                    <td>{{filiere.code_filiere}}</td>
                                    <td>{{filiere.libelle_filiere}}</td>
                                    <td>{{filiere.scolarite_filiere}}</td>
                                    <td>{{filiere.valeur_annee_scolaire}}</td>
                                    <td>{{filiere.libelle_cycle}}</td>
                                    <td>
                                        <div class="display-flex">
                                            <a @click="editFiliere(filiere.id)" class="btn-edit">Edit</a>
                                            <a @click="deleteFiliere(filiere.id)" class="btn-delete">Delete</a>
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
                        <h5 class="modal-title" id="exampleModalLabel">{{is_Editing ?"Update Filiere":"Add New Filiere"}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="is_Editing ? updateFiliere() : createFiliere()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" v-model="filiere.code_filiere"  id="code_filiere" placeholder="Code de la filiere..." class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-model="filiere.libelle_filiere"  id="libelle_filiere" placeholder="Nom de la filiere..." class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-model="filiere.description_filiere" id="description_filiere" placeholder="Description de la filiere..." class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-model="filiere.scolarite_filiere"  id="scolarite_filiere" placeholder="Scolarite de la filiere..." class="form-control">
                            </div>
                            <div class="form-group">
                                <select  v-model="filiere.year_id" id="year_id" class="form-control">
                                    <option value="0" selected>Selectionner une Année</option>
                                    <option v-for="year in years" :key="year.id" :value="year.id" >{{year.valeur_annee_scolaire}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select  v-model="filiere.cycle_id" id="cycle_id" class="form-control">
                                    <option value="0" selected>Selectionner un Cycle</option>
                                    <option v-for="cycle in cycles" :key="cycle.id" :value="cycle.id" >{{cycle.libelle_cycle}}</option>
                                </select>
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
        name:"Filiere",
        data(){
            return{
                years:[],
                cycles:[],
                dFilieres:[],
                filieres :[],
                filiere:{
                    code_filiere:'',
                    libelle_filiere:'',
                    description_filiere:'',
                    scolarite_filiere:'',
                    year_id:'',
                    cycle_id:'',               
                },
                edit_id:'',
                is_Editing:false,
                ret:{
                    valfil:"",
                    valAnn:"",
                    valcyc:"",
                },
              
            }
        },
        methods:{
            newModal(){
                this.filiere={
                    code_filiere:'',
                    libelle_filiere:'',
                    description_filiere:'',
                    scolarite_filiere:'',
                    year_id:'',
                    cycle_id:'', 
                }
                this.is_Editing = false;
                $('#addNew').modal('show');
            },
            /*************************************************************************/
                onFiliereChange(){
                    /*console.log("this.ret.valfil:",this.ret.valfil)
                    alert("this.ret.valfil:"+this.ret.valfil)*/
                            axios.get(`api/loadOnFiliereChange/${this.ret.valfil}/${this.ret.valAnn}/${this.ret.valcyc}`).then(res=>{
                                this.filieres=res.data
                            })           
                },
            /*************************************************************************/
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
            loadFilieres(){
                axios.get('api/filieres').then((filieres)=>{
                    this.filieres = filieres.data;
                })
            },
            createFiliere(){
                let cf = document.querySelector("#code_filiere").value;
                let lf = document.querySelector("#libelle_filiere").value;
                let df = document.querySelector("#description_filiere").value;
                let sf = document.querySelector("#scolarite_filiere").value;
                let yf = document.querySelector("#year_id").value;
                let cyf = document.querySelector("#cycle_id").value;

               
                /*if(cf ==""|| lf ==""|| sf ==""|| yf ==""|| cyf ==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }*/
                /*if(lf  =="" || sf =="" || yf =="" || cyf ==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }*/
                axios.post(`api/filieres`,this.filiere).then(()=>{
                    //$('#addNew').modal('hide');
                    Swal.fire('Created!','The Filiere has been created.','success') ;
                    this.loadFilieres();

                    this.filiere.code_filiere ="";
                    this.filiere.libelle_filiere="";
                    this.filiere.description_filiere="";
                    this.filiere.scolarite_filiere="";
                }).catch((err)=>{
                    Swal.fire('Error !!!','An Error Occured !!!','error')
                })
            },
            updateFiliere(){
                    axios.put(`api/filieres/${this.edit_id}`,this.filiere).then(()=>{
                        $('#addNew').modal('hide');
                        Swal.fire('Updated!','The Filiere has been updated.','success')    
                        this.loadFilieres();
                        this.edit_id = "";
                        this.is_Editing = false;
                    }).catch((errors)=>{
                        //console.log("valeur de err:",errors)
                        Swal.fire('Error !!!','An Error Occured !!!','error')
                    })
            },
            editFiliere(id){
                axios.get(`api/filieres/${id}`).then((res)=>{
                    $('#addNew').modal('show');
                    this.edit_id = res.data.id;
                    this.filiere.code_filiere = res.data.code_filiere;
                    this.filiere.libelle_filiere = res.data.libelle_filiere;
                    this.filiere.description_filiere = res.data.description_filiere;
                    this.filiere.scolarite_filiere = res.data.scolarite_filiere;
                    this.filiere.year_id = res.data.year_id;
                    this.filiere.cycle_id = res.data.cycle_id;
                    this.is_Editing = true;
                })
            },
            deleteFiliere(id){
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete(`api/filieres/${id}`).then(()=>{
                            
                                    Swal.fire(
                                    'Deleted!',
                                    'The Filiere has been deleted.',
                                    'success'
                                    )
                                
                                this.loadFilieres();
                            }).catch((err)=>{
                                Swal.fire('Error !!!','An Error Occured !!!','error')
                            })
                        }else{
                            Swal.fire('Cancelled !!!','The Filiere is safe for you !!!','error')
                        }
                })//first Then
            },//deleteFiliere
          
        },
        created(){
            this.loadFilieres();
            this.loadYears();
            this.loadCycles();
            this.loadDistinctFilieres();
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
    cursor: pointer;
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
    cursor: pointer;
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
