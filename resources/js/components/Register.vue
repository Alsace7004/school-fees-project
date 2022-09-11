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
                    <input type="text" class="form-control" placeholder="nom">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                    </div>
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
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirmer password">
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

            }
        },
        methods:{
            hello(){
                alert("hello every one, hope you are all fine Am Register Component!!!");
            },
            registerUser(){
                alert("Nouveau compte creer avec success !!!"+"\n Vous allez etre rediriger dans quelques instant...!!!");
                this.$router.push("/");
            }
          
        },
        mounted() {
            //this.hello();
            console.log('Component mounted.')
        }
    }
</script>
