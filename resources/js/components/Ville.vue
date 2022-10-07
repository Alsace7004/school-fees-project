<template>
    <div class="wrapper">
        <Nav/>
        <Aside/>
        <!--le contenu sera ici-->
        <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <Title titre="Villes" description="Liste des villes"/>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->
                            <div class="container">
                                <div class="row mt-2" >
                                    <!---->
                                            <div style="display: flex;justify-content: end;">
                                                <button class="btn-add" @click="newModal" data-toggle="modal" data-target="#addNew">Ajouter</button>
                                            </div>
                                            <!--table-->
                                            <div class="tbl-header">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th>Nom de la ville</th>
                                                            <th>Description de la ville</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tbl-content">
                                                <table>
                                                    <tbody>
                                                        <tr v-if="!villes.length" class="text-center text-danger" style="font-weight:bolder;margin:0px auto">Pas encore de villes disponible</tr>
                                                        <tr v-for="(ville,i) in villes" :key="ville.id">
                                                            <td>{{i=i+1}}</td>
                                                            <td>{{ville.libelle_ville}}</td>
                                                            <td>{{ville.description_ville}}</td>
                                                            <td>
                                                                <div class="display-flex">
                                                                    <button @click="editVille(ville.id)" class="btn-edit">Edit</button>
                                                                    <button @click="deleteVille(ville.id)" class="btn-delete">Delete</button>
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
                                                <h5 class="modal-title" id="exampleModalLabel">{{is_Editing ?"Update Ville":"Add New Ville"}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form @submit.prevent="is_Editing ? updateVille() : createVille()">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" v-model="ville.libelle_ville"  id="libelle_ville" placeholder="Nom de la ville..." class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" v-model="ville.description_ville" id="description_ville" placeholder="description de la ville..." class="form-control">
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
    import axiosClient from "../axios/index";
    export default {
        name:"Ville",
        components:{
            Nav,Aside,Footer,Title
        },
        data(){
            return{
                villes:[],
                ville:{
                    libelle_ville:'',
                    description_ville:'',
                },
                edit_id:'',
                is_Editing:false,
            }
        },
        methods:{
            newModal(){
                this.ville={
                    libelle_ville:'',
                    description_ville:'',
                }
                this.is_Editing = false;
                $('#addNew').modal('show');
            },
            loadVilles(){
                axiosClient.get('api/villes').then((villes)=>{
                    this.villes = villes.data;
                })
            },
            createVille(){
                let lv = document.querySelector("#libelle_ville").value;
                let dv = document.querySelector("#description_ville").value;
                if(lv =="" || dv==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }
                axiosClient.post(`api/villes`,this.ville).then(()=>{
                    //$('#addNew').modal('hide');
                    Swal.fire('Created!','The Ville has been created.','success') ;
                    this.loadVilles();

                    this.ville.libelle_ville ="";
                    this.ville.description_ville="";
                }).catch((err)=>{
                    Swal.fire('Error !!!','An Error Occured !!!','error')
                })
            },
            deleteVille(id){
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
                            axiosClient.delete(`api/villes/${id}`).then(()=>{
                            
                                    Swal.fire(
                                    'Deleted!',
                                    'The Ville has been deleted.',
                                    'success'
                                    )
                                
                                this.loadVilles();
                            }).catch((err)=>{
                                Swal.fire('Error !!!','An Error Occured !!!','error')
                            })
                        }else{
                            Swal.fire('Cancelled !!!','The Ville is safe for you !!!','error')
                        }
                })//first Then
            },//deleteCycle
            editVille(id){
                axiosClient.get(`api/villes/${id}`).then((res)=>{
                    $('#addNew').modal('show');
                    this.edit_id = res.data.id;
                    this.ville.libelle_ville = res.data.libelle_ville;
                    this.ville.description_ville = res.data.description_ville;
                    this.is_Editing = true;
                })
            },
            updateVille(){
                    axiosClient.put(`api/villes/${this.edit_id}`,this.ville).then(()=>{
                        $('#addNew').modal('hide');
                        Swal.fire('Updated!','The ville has been updated.','success')    
                        this.loadVilles();
                        this.edit_id = "";
                        this.is_Editing = false;
                    }).catch((err)=>{
                        Swal.fire('Error !!!','An Error Occured !!!','error')
                    })
            }
          
        },
        created(){
            this.loadVilles();
        },
        mounted() {
            var ville = document.querySelector('.ville');
            var dash = document.querySelector('.dash');
            dash.classList.remove('active');
            ville.classList.add('active');
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
