<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Admin Web Control</title>

<link rel="stylesheet" href="{{asset('css/libs.css')}}">
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="{{route('movie.index')}}" class="logo">Nice <span class="lite">Admin</span></a>
      <!--logo end-->

 

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" width="30" height="30" src="/img/avatar1.jpg">
                            </span>
                          <span class="username">{{ucfirst(Auth::user()->name)}}</span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li>
              <a href="{{route('logout')}}"><i class="icon_key_alt"></i> Log Out</a>
              </li>
        
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>Movies</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route('movie.index')}}">View Movies</a></li>
              <li><a class="" href="{{route('movie.create')}}">Create Movie</a></li> 
            </ul>
          </li>
                 
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_film"></i>
                          <span>Serie</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">           
              <li><a class="" href="{{route('serie.index')}}">Series</a></li>
              <li><a class="" href="{{route('serie.create')}}">Create Serie</a></li>
            </ul>
          </li>

          <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_film"></i>
                            <span>Season</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('season.index')}}">Seasons</a></li>
                <li><a class="" href="{{route('season.create')}}">Create Season</a></li>
              </ul>
            </li>
            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_film"></i>
                            <span>Episode</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('episode.index')}}">Episodes</a></li>
                <li><a class="" href="{{route('episode.create')}}">Create Episode</a></li>
              </ul>
            </li>


          

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>


   @yield('content')



       
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

<script src="{{asset('js/libs.js')}}"></script>

  @yield('footer')
</body>

</html>
