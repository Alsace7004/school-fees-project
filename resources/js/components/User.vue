<template>
    <div class="container">
        <div class="row mt-5" >
                       <!---->
                    <div style="display: flex;justify-content: end;">
                        <button class="btn-add">Ajouter</button>
                    </div>
                    <!--table-->
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Gender</th>
                                    <th>Succursale</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Jhon</td>
                                    <td>Doe</td>
                                    <td>M</td>
                                    <td>Avedji</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="display-flex">
                                            <a href="" class="btn-edit">Edit</a>
                                            <a href="" class="btn-delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jhon</td>
                                    <td>Doe</td>
                                    <td>M</td>
                                    <td>Avedji</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="display-flex">
                                            <a href="" class="btn-edit">Edit</a>
                                            <a href="" class="btn-delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jhon</td>
                                    <td>Doe</td>
                                    <td>M</td>
                                    <td>Avedji</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="display-flex">
                                            <a href="" class="btn-edit">Edit</a>
                                            <a href="" class="btn-delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jhon</td>
                                    <td>Doe</td>
                                    <td>M</td>
                                    <td>Avedji</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="display-flex">
                                            <a href="" class="btn-edit">Edit</a>
                                            <a href="" class="btn-delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jhon</td>
                                    <td>Doe</td>
                                    <td>M</td>
                                    <td>Avedji</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="display-flex">
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
    </div>
</template>

<script>
    export default {
        name:"User",
        data(){
            return{

            }
        },
        methods:{
            hello(){
                alert("hello every one, hope you are all fine!!!");
           }
          
        },
        mounted() {
            //this.hello();
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

