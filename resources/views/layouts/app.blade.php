<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Vitajus') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="all,follow">
    <!--Dashboard Links start here-->
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{(url('https://use.fontawesome.com/releases/v5.3.1/css/all.css'))}}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="{{url('https://fonts.googleapis.com/css?family=Poppins:300,400,800')}}">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{asset('css/dashboardcss/orionicons.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/dashboardcss/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/dashboardcss/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <!-- Iconfont-->
    <link rel="stylesheet" href="{{asset('dashboardfonts/iconfont.css')}}">
    <!--modal style-->
    <link rel="stylesheet" href="{{asset('css/modalstyle.css')}}">

</head>
<body>

<!--MAIN START HERE-->

@section('header')
    <header class="header">
        <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="{{route('dashboard')}}" class="navbar-brand font-weight-bold text-uppercase text-base">Vitajus Company</a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
                <li class="nav-item">
                    <form id="searchForm" class="ml-auto d-none d-lg-block">
                        <div class="form-group position-relative mb-0">
                            <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                            <input type="search" placeholder="Search ..." class="form-control form-control-sm border-0 no-shadow pl-4">
                        </div>
                    </form>
                </li>
               <!-- <li class="nav-item dropdown mr-3"><a id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
                    <div aria-labelledby="notifications" class="dropdown-menu"><a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                                <div class="text ml-2">
                                    <p class="mb-0">You have 2 followers</p>
                                </div>
                            </div></a><a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                                <div class="text ml-2">
                                    <p class="mb-0">You have 6 new messages</p>
                                </div>
                            </div></a><a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-blue text-white"><i class="fas fa-upload"></i></div>
                                <div class="text ml-2">
                                    <p class="mb-0">Server rebooted</p>
                                </div>
                            </div></a><a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                                <div class="text ml-2">
                                    <p class="mb-0">You have 2 followers</p>
                                </div>
                            </div></a>
                        <div class="dropdown-divider"></div><a href="#" class="dropdown-item text-center"><small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small></a>
                    </div>
                </li>-->
                <li class="nav-item dropdown ml-auto"><a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="{{asset('img/avatar-6.jpg')}}" alt="Jason Doe" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
                    <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family">Administrateur </strong><small>Ali chaieb</small></a>
                        <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Settings</a><a href="#" class="dropdown-item">Activité       </a>

                        <!-- Authentication Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="dropdown-divider"></div><a href="{{ route('logout') }}"
                                                                   onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="dropdown-item">Logout</a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

@show

<div class="d-flex align-items-stretch">
    <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
            <li class="sidebar-list-item"><a href="{{route('dashboard')}}" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Accueil</span></a></li>

            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#home" aria-expanded="false" aria-controls="home" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Gestion des personnels</span></a>
                <div id="home" class="collapse @if(request()->routeIs('checkin')) show @endif @if(request()->routeIs('salary')) show @endif @if(request()->routeIs('update-workers')) show @endif">
                    <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                        <li class="sidebar-list-item"><a href="{{route('checkin')}}" class="sidebar-link text-muted pl-lg-5">Pointage</a></li>
                        <li class="sidebar-list-item"><a href="{{route('salary')}}" class="sidebar-link text-muted pl-lg-5">Salaire et avances</a></li>
                        <li class="sidebar-list-item"><a href="{{route('update-workers')}}" class="sidebar-link text-muted pl-lg-5">Mise a jour personnels</a></li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#charts" aria-expanded="false" aria-controls="charts" class="sidebar-link text-muted"><i class="o-sales-up-1 mr-3 text-gray"></i><span>Gestion de stock</span></a>
                <div id="charts" class="collapse @if(request()->routeIs('pri-suplies')) show @endif @if(request()->routeIs('stock-distribution')) show @endif @if(request()->routeIs('total-stock')) show @endif">
                    <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                        <li class="sidebar-list-item"><a href="{{route('pri-suplies')}}" class="sidebar-link text-muted pl-lg-5">Matiére primaire</a></li>
                        <li class="sidebar-list-item"><a href="{{route('stock-distribution')}}" class="sidebar-link text-muted pl-lg-5">Stock & Distrubution</a></li>
                        <li class="sidebar-list-item"><a href="{{route('total-stock')}}" class="sidebar-link text-muted pl-lg-5">Total MP & ST & Dis</a></li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#tables" aria-expanded="false" aria-controls="tables" class="sidebar-link text-muted"><i class="o-table-content-1 mr-3 text-gray"></i><span>Gestion de paix & charges</span></a>
                <div id="tables" class="collapse @if(request()->routeIs('monthly-pay')) show @endif @if(request()->routeIs('charges-topay')) show @endif @if(request()->routeIs('total-charges')) show @endif">
                    <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                        <li class="sidebar-list-item"><a href="{{route('monthly-pay')}}" class="sidebar-link text-muted pl-lg-5">Salaires personnels</a></li>
                        <li class="sidebar-list-item"><a href="{{route('charges-topay')}}" class="sidebar-link text-muted pl-lg-5">Euax et éléctricité</a></li>
                        <li class="sidebar-list-item"><a href="{{route('total-charges')}}" class="sidebar-link text-muted pl-lg-5">Total charges</a></li>
                    </ul>
                </div>
            </li>
            <!-- Authentication Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="sidebar-list-item"><a href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="sidebar-link text-muted"><i class="o-exit-1 mr-3 text-gray"></i><span>Logout</span></a></li>

            </form>
        </ul>
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>
        <ul class="sidebar-menu list-unstyled">
            <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Demo</span></a></li>
        </ul>
    </div>
    <!-- Main start here -->
    <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
            <!-- items start here -->
            @if(request()->routeIs('dashboard'))
                @include('items.index')
                @endif
        @yield('content')
        <!-- items End here -->
        </div>
        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left text-primary">
                        <p class="mb-2 mb-md-0">Said ben hmed - vitajus &copy; 2021-2022</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!--MAIN END HERE-->

<!-- JavaScript files-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset(('vendor/chart.js/Chart.min.js'))}}"></script>
<script src="{{asset('js/dashboardjs/charts-home.js')}}"></script>
<script src="{{asset('js/dashboardjs/front.js')}}"></script>
<script src="{{asset('js/ajax-requests/searchAdvencePay.js')}}"></script>
<script src="{{asset('js/ajax-requests/verifCode.js')}}"></script>
</body>
</html>
