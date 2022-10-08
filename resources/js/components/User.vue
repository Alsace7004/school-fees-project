<template>
    <div class="wrapper">
        <Nav/>
        <Aside/>
        <!--le contenu sera ici-->
        <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <Title titre="Personnels" description="Liste du personnel"/>
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
                                                            <th>#</th>
                                                            <th>Nom</th>
                                                            <th>Email</th>
                                                            <!--<th>Succursale</th>-->
                                                            <th>Role</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tbl-content">
                                                <table>
                                                    <tbody>
                                                        <tr v-for="(user,i) in users" :key="user.id">
                                                            <td>{{i=i+1}}</td>
                                                            <td>{{user.name}}</td>
                                                            <td>{{user.email}}</td>
                                                            <!--<td>Avedji</td>-->
                                                            <td>{{user.role_name}}</td>
                                                            <td>
                                                                <div class="display-flex">
                                                                    <a @click="editUser(user.id)" class="btn-edit">Edit</a>
                                                                    <a @click="deleteUser(user.id)" class="btn-delete">Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                              
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--table-->
                                    <!---->
                                </div>
                            </div>
                            <!-- /.row (main row) -->
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>

                <!-- Modal -->
                                <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{is_Editing ?"Mise à jour utilisateur":"Ajouter nouvel utilisateur"}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form @submit.prevent="is_Editing ? updateUser() : createUser()">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" v-model="user.name"  id="user_name" placeholder="user name..." class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" v-model="user.email" id="user_email" placeholder="user email..." class="form-control">
                                                    </div>

                                                    
                                                        <div class="form-group">
                                                        
                                                            <select  v-model="user.roles" id="role_id" class="form-control">
                                                                <option value="Selectionner un Role" selected>Selectionner un Role</option>
                                                                <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
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
        name:"User",
        components:{
            Nav,Aside,Footer,Title
        },
        data(){
            return{
                roles:[],
                users:[],
                user:{
                    name:'',
                    email:'',
                    password:'123456789',
                    roles:''
                },
                edit_id:'',
                is_Editing:false,
            }
        },
        methods:{
            newModal(){
                this.user={
                    name:'',
                    email:'',
                    password:'123456789'
                }
                this.is_Editing = false;
                $('#addNew').modal('show');
            },
            loadRoles(){
                axiosClient.get('api/roles').then((roles)=>{
                    this.roles = roles.data;
                })
            },
            getAllUsers(){
                axiosClient.get('api/users').then((res)=>{
                    //console.log("valeur de res:",res);
                    this.users = res.data;
                    //console.log("valeur de users:",users);
                })
            },
            createUser(){
                let lv = document.querySelector("#user_name").value;
                let dv = document.querySelector("#user_email").value;
                if(lv =="" || dv==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }
                axiosClient.post(`api/users`,this.user).then(()=>{
                    //$('#addNew').modal('hide');
                    Swal.fire('Created!','Utilisateur Creer avec success.','success') ;
                    this.getAllUsers();

                    this.user.name ="";
                    this.user.email="";
                    this.user.password="";
                }).catch((err)=>{
                    Swal.fire('Error !!!','An Error Occured !!!','error')
                })
            },
            deleteUser(id){
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
                            axiosClient.delete(`api/users/${id}`).then(()=>{
                            
                                    Swal.fire(
                                    'Deleted!',
                                    'Utilisateur a été supprimé.',
                                    'success'
                                    )
                                
                                this.getAllUsers();
                            }).catch((err)=>{
                                Swal.fire('Error !!!','An Error Occured !!!','error')
                            })
                        }else{
                            Swal.fire('Cancelled !!!','The Ville is safe for you !!!','error')
                        }
                })//first Then
            },//deleteUser
            editUser(id){
                axiosClient.get(`api/users/${id}`).then((res)=>{
                    $('#addNew').modal('show');
                    //console.log('valeur de res:',res.data)
                    this.edit_id = res.data[0].id;
                    this.user.name = res.data[0].name;
                    this.user.email = res.data[0].email;
                    this.user.roles = res.data[0].role_id;
                    this.is_Editing = true;
                })
            },//editUser
            updateUser(){
                    axiosClient.put(`api/users/${this.edit_id}`,this.user).then(()=>{
                        $('#addNew').modal('hide');
                        Swal.fire('Updated!','Utilisateur mise à jour avec success.','success')    
                        this.getAllUsers();
                        this.edit_id = "";
                        this.is_Editing = false;
                    }).catch((err)=>{
                        Swal.fire('Error !!!','Une Erreur Survenue !!!','error')
                    })
            },//updateUser
          
        },
        mounted() {
            /*var personnel = document.querySelector('.personnel');
            var dash = document.querySelector('.dash');
            dash.classList.remove('active');
            personnel.classList.add('active');*/
        },
        created(){
            this.getAllUsers();
            this.loadRoles();
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

