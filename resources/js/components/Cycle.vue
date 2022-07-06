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
                                    <th>Id</th>
                                    <th>Code cycle</th>
                                    <th>Libelle cycle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table>
                            <tbody>
                                <tr v-for="cycle in cycles" :key="cycle.id">
                                    <td>{{cycle.id}}</td>
                                    <td>{{cycle.code_cycle}}</td>
                                    <td>{{cycle.libelle_cycle}}</td>
                                    <td>
                                        <div class="display-flex">
                                            <button @click="editCycle(cycle.id)" class="btn-edit">Edit</button>
                                            <button @click="deleteCycle(cycle.id)" class="btn-delete">Delete</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">{{is_Editing ?"Update Cycle":"Add New Cycle"}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="is_Editing ? updateCycle() : createCycle()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" v-model="cycle.code_cycle"  id="code_cycle" placeholder="Code du cycle..." class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" v-model="cycle.libelle_cycle" id="libelle_cycle" placeholder="Libelle du cycle..." class="form-control">
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
        name:"Cycle",
        data(){
            return{
                cycles:[],
                cycle:{
                    code_cycle:'',
                    libelle_cycle:'',
                },
                edit_id:'',
                is_Editing:false,
            }
        },
        methods:{
            newModal(){
                this.cycle={
                    code_cycle:'',
                    libelle_cycle:'',
                    }
                this.is_Editing = false;
                $('#addNew').modal('show');
            },
            loadCycles(){
                axios.get('api/cycles').then((cycles)=>{
                    this.cycles = cycles.data;
                    //console.log("valeur des cycles:",cycles.data);
                })
            },
            createCycle(){
                let cc = document.querySelector("#code_cycle").value;
                let lc = document.querySelector("#libelle_cycle").value;
                if(cc =="" || lc==""){
                    Toast.fire({icon: 'error',title: 'veuillez remplir tous les champs !!!'});
                    return;
                }
                axios.post(`api/cycles`,this.cycle).then(()=>{
                    //$('#addNew').modal('hide'); 
                    Swal.fire('Created!','The Cycle has been created.','success') ;
                    this.loadCycles();

                    this.cycle.code_cycle ="";
                    this.cycle.libelle_cycle="";
                }).catch((err)=>{
                    Swal.fire('Error !!!','An Error Occured !!!','error')
                })
            },
            deleteCycle(id){
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
                            axios.delete(`api/cycles/${id}`).then(()=>{
                            
                                    Swal.fire(
                                    'Deleted!',
                                    'The Cycle has been deleted.',
                                    'success'
                                    )
                                
                                this.loadCycles();
                            }).catch((err)=>{
                                Swal.fire('Error !!!','An Error Occured !!!','error')
                            })
                        }else{
                            Swal.fire('Cancelled !!!','The Cycle is safe for you !!!','error')
                        }
                })//first Then
            },//deleteCycle
            editCycle(id){
                axios.get(`api/cycles/${id}`).then((res)=>{
                    $('#addNew').modal('show');
                    this.edit_id = res.data.id;
                    this.cycle.code_cycle = res.data.code_cycle;
                    this.cycle.libelle_cycle = res.data.libelle_cycle;
                    this.is_Editing = true;
                })
            },
            updateCycle(){
                    axios.put(`api/cycles/${this.edit_id}`,this.cycle).then(()=>{
                        $('#addNew').modal('hide');
                        Swal.fire('Updated!','The cycle has been updated.','success')    
                        this.loadCycles();
                        this.edit_id = "";
                        this.is_Editing = false;
                    }).catch((err)=>{
                        Swal.fire('Error !!!','An Error Occured !!!','error')
                    })
            },
            
          
        },
        created(){
            this.loadCycles();
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
/***********************BTN-DESIGN***END****************************/
</style>
