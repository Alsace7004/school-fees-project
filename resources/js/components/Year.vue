<template>
    <div class="container">
        <div class="row mt-5" >
             <!---->
                    <div class="d-flex justify-content-end">
                        <button class="btn-add" @click="newModal" data-toggle="modal" data-target="#addNew">Ajouter</button>
                    </div>
                    <!--table-->
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Années Scolaires</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table>
                            <tbody>
                                <tr v-for="year in years" :key="year.id">
                                    <td>{{year.id}}</td>
                                    <td>{{year.valeur_annee_scolaire}}</td>
                                    <td>
                                        <div class="display-flex">
                                            <button @click="editYear(year)" class="btn-edit">Edit</button>
                                            <button @click="deleteYear(year.id)" class="btn-delete">Delete</button>
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
                        <h5 v-show="editmode" class="modal-title" id="exampleModalLabel">Update Year</h5>
                        <h5 v-show="!editmode" class="modal-title" id="exampleModalLabel">Add New Year</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateYear() : createYear()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" v-model="form.valeur_annee_scolaire" id="valeur_annee_scolaire" name="valeur_annee_scolaire" placeholder="Année Scolaire..." class="form-control">
                                <!--<div v-if="form.errors.has('valeur_annee_scolaire')" v-html="form.errors.get('valeur_annee_scolaire')" />-->
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
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
        name:"Year",
        data(){
            return{
                editmode:false,
                years:[],
                form: new Form({
                    id:'',
                    valeur_annee_scolaire: ''
                })
            }
        },
        methods:{
            updateYear(){
                this.form.put(`api/years/${this.form.id}`).then(()=>{
                        $('#addNew').modal('hide');
                        Swal.fire('Updated!','The year has been updated.','success')    
                        this.loadYears();
                    }).catch((err)=>{
                        Swal.fire('Error !!!','An Error Occured !!!','error')
                    })
            },
            editYear(year){
                this.form.reset();
                this.editmode = true;
                $('#addNew').modal('show');
                this.form.fill(year);
            },
            newModal(){
                this.form.reset();
                this.editmode = false;
                $('#addNew').modal('show');
            },
            loadYears(){
                axios.get('api/years').then((data)=>{
                    this.years = data.data;
                })
            },
            createYear(){
                
                var yearName = document.querySelector('#valeur_annee_scolaire');
                if(yearName.value === ''){
                    Toast.fire({
                        icon: 'error',
                        title: 'veuillez entrer une année scolaire'
                    });
                    return;
                }
      
                this.form.post('api/years').then(()=>{
                  
                    Swal.fire('Created!','The year has been created.','success')  
                    this.loadYears();
                     //$('#addNew').modal('hide');
                }).catch((err)=>{
                    Swal.fire('Error !!!','An Error Occured !!!','error')
                });
              
            },
            deleteYear(id){
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
                            this.form.delete(`api/years/${id}`).then(()=>{
                            
                                    Swal.fire(
                                    'Deleted!',
                                    'The year has been deleted.',
                                    'success'
                                    )
                                
                                this.loadYears();
                            }).catch((err)=>{
                                Swal.fire('Error !!!','An Error Occured !!!','error')
                            })
                        }else{
                            Swal.fire('Cancelled !!!','The Year is safe for you !!!','error')
                        }
                })//first Then
            },//deleteYear
          
        },
        created(){
            this.loadYears();
        },
        mounted() {
            console.log('Component mounted.')
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
.fd{
    display: flex;
    justify-content: flex-end;
}
/***********************BTN-DESIGN***END****************************/
</style>
