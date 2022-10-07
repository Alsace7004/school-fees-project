<template>
    <div class="container">
        <div class="row justify-content-center mt-5" >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">You are welcome on my school-fees-managment app</div>

                    <div class="card-body">
                       What can i do for you man!!!
                        <p>    I just wana make an app on school fees managment with vue,
                                so am here!!!!
                        </p>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Default",
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
            this.hello();
            console.log('Component mounted.')
        }
    }
</script>
