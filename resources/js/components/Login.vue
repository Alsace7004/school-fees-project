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
                    <input type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password">
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
                    <router-link to="/register" class="text-center">Crer un nouveau compte</router-link>
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

            }
        },
        methods:{
            hello(){
                alert("hello every one, hope you are all fine Am login Component!!!");
            },
            loginUser(){
                alert("Bienvenue sur l'application de gestion de frais de scolarité"+"\n Vous allez etre rediriger dans quelques instants...!!!")
            }
          
        },
        mounted() {
            //this.hello();
            console.log('Component mounted.')
        }
    }
</script>
