<template>
    <div class="register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="/"><b>Fees</b>Bank</a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                <p class="login-box-msg">Creer un nouveau compte</p>

                <form @submit.prevent="registerUser">
                    <div class="input-group mb-3">
                        <input type="text" v-model="user.name" class="form-control" placeholder="nom">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" v-model="user.password_conf" class="form-control" placeholder="Confirmer password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Creer un compte</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>

               

                <router-link to="/login" class="text-center">Déjà un compte ? Veuillez-vous connecter</router-link>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
</template>

<script>
    export default {
        name:"Register",
        data(){
            return{
                user:{
                    name:'',
                    email:'',
                    password:'',
                    password_conf:''
                }
            }
        },
        methods:{
            registerUser(){
                axios.post('api/register',this.user).then((res)=>{
                    Swal.fire('Success !!!',`Nouveau compte creer avec success !!! \n Vous allez etre rediriger dans quelques instant...!!!`,'success')
                    this.$router.push("/login");
                }).catch((error)=>{
                    console.log("valeur de err dans register : ",error.response)
                    if(error.response.data.err.name){
                        Toast.fire({icon: 'error',title: `${error.response.data.err.name[0]}`});
                        //return;
                    }else if(error.response.data.err.email){
                        Toast.fire({icon: 'error',title: `${error.response.data.err.email[0]}`});
                        //return;
                    }else if(error.response.data.err.password){
                        Toast.fire({icon: 'error',title: `${error.response.data.err.password[0]}`});
                        //return;
                    }else{
                         Swal.fire('Error !!!',`Une erreur est survenue`,'error')
                        //return;
                    }
                    
                })
            }
          
        },
        mounted() {
            //this.hello();
            console.log('Component mounted.')
        }
    }
</script>
