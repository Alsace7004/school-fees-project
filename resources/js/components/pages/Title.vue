<template>
  <div>
    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{titre}}</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><router-link to="/">Tableau de Bord</router-link></li>
                                <li class="breadcrumb-item active">{{description}}</li>
                                </ol>
                            </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
    <!-- /.content-header -->
  </div>
</template>

<script>
export default {
  name: "Title",
  props: {
    titre:String,
    description:String
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>
