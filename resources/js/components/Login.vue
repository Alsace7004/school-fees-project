<template>
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="/"><b>Fees</b>Bank</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                <p class="login-box-msg">Veuillez-vous connecter</p>

                <form @submit.prevent="loginUser">
                    <div class="input-group mb-3">
                    <input type="email" class="form-control" v-model="user.email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" v-model="user.password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Se Connecter</button>
                        </div>
                    <!-- /.col -->
                    </div>
                </form>

                
                <!-- /.social-auth-links -->
                <p class="mb-0">
                    <!--<router-link to="/register" class="text-center">Crer un nouveau compte</router-link>-->
                </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Login",
        data(){
            return{
                user:{
                    email:'',
                    password:'',
                }
            }
        },
        methods:{
           
            loginUser(){
                //alert("Bienvenue sur l'application de gestion de frais de scolarité"+"\n Vous allez etre rediriger dans quelques instants...!!!")
                //this.$router.push("/");
                axios.post('api/login',this.user).then((res)=>{
                    console.log("valeur de res dans login component :",res.data)
                    localStorage.clear(); 
            
                    if(res.data.status_code == 200){
                        const token = res.data.token;
                        const email = res.data.user.email;
                        const role = res.data.role;
                  
                        localStorage.setItem("jwt",token);
                        localStorage.setItem("username",email);
                        localStorage.setItem("role",role);

                        if(token && email && (role ==="Admin" || role ==="Secretaire" || role==="Caissier")){
                            Swal.fire('Reussi!','Connexion reussi!!!.','success') ;
                            this.$router.push("/");
                        }else{
                            Swal.fire('Error !!!','Une Erreur Survenue  token+username!!!','error')
                        }
                    }else{
                        Swal.fire('Error !!!',`Une erreur est survenue 200`,'error')
                    }
                }).catch((error)=>{
                    //console.log('avl de err:',error.response.data.status_code == 400);
                    if(error.response.data.status_code == 400){
                        Toast.fire({icon: 'error',title: `${error.response.data.message}`});
                        return;
                    }else 
                    if(error.response.data.err.email){
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
