<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>School | Fees</title>
            
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset("admin/plugins/fontawesome-free/css/all.min.css")}}" type="text/css">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{asset("admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}" type="text/css">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset("admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}" type="text/css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{asset("admin/plugins/jqvmap/jqvmap.min.css")}}" type="text/css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset("admin/dist/css/adminlte.min.css")}}" type="text/css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset("admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}" type="text/css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset("admin/plugins/daterangepicker/daterangepicker.css")}}" type="text/css">
        <!-- summernote -->
        <link rel="stylesheet" href="{{asset("admin/plugins/summernote/summernote-bs4.min.css")}}" type="text/css">
        <!----------------------------------------------->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div id="app">
            <router-view></router-view>
        </div>
     
    </body>
    
    <script src="{{ mix('/js/app.js') }}"></script>
    <!-- jQuery -->
        <script src="{{asset("admin/plugins/jquery/jquery.min.js")}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset("admin/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{asset("admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
        <!-- ChartJS -->
        <script src="{{asset("admin/plugins/chart.js/Chart.min.js")}}"></script>
        <!-- Sparkline -->
        <script src="{{asset("admin/plugins/sparklines/sparkline.js")}}"></script>
        <!-- JQVMap -->
        <script src="{{asset("admin/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
        <script src="{{asset("admin/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{asset("admin/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
        <!-- daterangepicker -->
        <script src="{{asset("admin/plugins/moment/moment.min.js")}}"></script>
        <script src="{{asset("admin/plugins/daterangepicker/daterangepicker.js")}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{asset("admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
        <!-- Summernote -->
        <script src="{{asset("admin/plugins/summernote/summernote-bs4.min.js")}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{asset("admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset("admin/dist/js/adminlte.js")}}"></script>
        <!-- AdminLTE for demo purposes -->
         
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset("admin/dist/js/pages/dashboard.js")}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
     
</html>
