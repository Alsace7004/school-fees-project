<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fees | Starter</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!---->
        <link rel="stylesheet" type="text/css" href="{{asset('cms/dist/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('cms/dist/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('cms/dist/fontawesome/css/fontawesome.min.css')}}">
        <!-- own stylesheet -->
        <link rel="stylesheet" type="text/css" href="{{asset('cms/own/css/fonts.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('cms/own/css/index.css')}}">
        <!---->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
      
    </head>
    <body class="antialiased">
        <div id="app">
          
            <!-- navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-info shadow">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="#" width="30" height="30" class="d-inline-block align-top" alt="">
                    <span class="menu-collapsed">Fees</span>
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#top">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#top">Pricing</a>
                        </li>
                        <!-- This menu is hidden in bigger devices with d-sm-none. 
                    The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
                        <li class="nav-item dropdown d-sm-block d-md-none">
                            <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                            <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                                <a class="dropdown-item" href="#top">hjsahgjsa</a>
                                <a class="dropdown-item" href="#top">Profile</a>
                                <a class="dropdown-item" href="#top">Tasks</a>
                                <a class="dropdown-item" href="#top">Etc ...</a>
                            </div>
                        </li><!-- Smaller devices menu END -->
                    </ul>
                </div>
            </nav>
            <!-- NavBar END -->
            <!-- Bootstrap row -->
            <div class="row" id="body-row">
                <!-- Sidebar -->
                <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
                    <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
                    <!-- Bootstrap List Group -->
                    <ul class="list-group">
                        <!-- Separator with title -->
                        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                            <small>MAIN MENU</small>
                        </li>
                        <!-- /END Separator -->
                        <!-- Menu with submenu -->
                        <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-cube fa-fw mr-3"></span>
                                <span class="menu-collapsed">Dashboard</span>
                                <span class="submenu-icon ml-auto"><i class="fa fa-angle-right"></i></span>
                            </div>
                        </a>
                        <!-- Submenu content -->
                        <div id='submenu1' class="collapse sidebar-submenu">
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                                <span class="menu-collapsed">Chahgag</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                                <span class="menu-collapsed">Reports</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                                <span class="menu-collapsed">Tables</span>
                            </a>
                        </div>
                        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-user fa-fw mr-3"></span>
                                <span class="menu-collapsed">Users</span>
                                <span class="submenu-icon ml-auto"><i class="fa fa-angle-right"></i></span>
                            </div>
                        </a>
                        <!-- Submenu content -->
                        <div id='submenu2' class="collapse sidebar-submenu">
                            <router-link to="/users" class="list-group-item list-group-item-action bg-dark text-white">
                                <span class="menu-collapsed">Users</span>
                            </router-link>
                            <router-link to="/etudiants" class="list-group-item list-group-item-action bg-dark text-white">
                                <span class="menu-collapsed">Etudiants</span>
                            </router-link>
                        </div>
                        <router-link to="/filieres" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-tasks fa-fw mr-3"></span>
                                <span class="menu-collapsed">Filieres</span>
                            </div>
                        </router-link>
                        <!-- Separator with title -->
                        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                            <small>OPTIONS</small>
                        </li>
                        <!-- /END Separator -->
                        <router-link to="/villes" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-calendar fa-fw mr-3"></span>
                                <span class="menu-collapsed">Villes</span>
                            </div>
                        </router-link>
                        <router-link to="/succursales" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="mr-3"><i class="fa fa-envelope"></i></span>
                                <span class="menu-collapsed">Succursales <span class="badge badge-pill badge-primary ml-2">5</span></span>
                            </div>
                        </router-link>
                        <!-- Separator without title -->
                        <li class="list-group-item sidebar-separator menu-collapsed"></li>
                        <!-- /END Separator -->
                        <router-link to="/years" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-question fa-fw mr-3"></span>
                                <span class="menu-collapsed">Années Scolaires</span>
                            </div>
                        </router-link>
                        <router-link to="/cycles" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span id="collapse-icon" class="mr-3"><i class="fa fa-outdent"></i></span>
                                <span id="collapse-text" class="menu-collapsed">Cycles</span>
                            </div>
                        </router-link>
                    </ul><!-- List Group END-->
                </div><!-- sidebar-container END -->
                <!-- MAIN -->
                <div class="col container-fluid bg-white p-4">
                        <div class="card-body">
                            <router-view></router-view>
                        </div>
                </div>
                <!-- Main Col END -->
            </div>
            <!-- body-row END -->
        <!----> 
        </div>
     
    </body>
    
    <script src="{{ mix('/js/app.js') }}"></script>
    <!--custum dashboard style-->
    <script src="{{asset('cms/dist/jquery/jquery-3.0.0.min.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{asset('cms/dist/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- fontawesome -->
    <script src="{{asset('cms/dist/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset('cms/dist/fontawesome/js/fontawesome.min.js')}}"></script>
</html>
