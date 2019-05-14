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
      <a href="index.html" class="logo">Nice <span class="lite">Admin</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            {!! Form::open(['method'=>'GET','route' => ['result']]) !!}
            <input class="form-control" placeholder="Search" type="text" name='title'>
            {!! Form::close() !!}
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
           <!-- inbox notificatoin start-->
           <li id="mail_notificatoin_bar" class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <i class="glyphicon glyphicon-envelope"></i>
              <span class="badge bg-important">{{session('counter')}}</span>
                          </a>
              <ul class="dropdown-menu extended inbox">
                <div class="notify-arrow notify-arrow-blue"></div>
                <li>
                  <p class="blue">You have {{session('counter')}} new messages</p>
                </li>
                @isset($indexmessage)
                    
                @foreach ($indexmessage as $item)
                <li>
                  <a href="{{route('message')}}">
                                      <span class="subject">
                                      <span class="from text-primary">{{$item->firstname}}</span>
                                      <span class="time text-danger">{{$item->created_at->diffForHumans()}}</span>
                                      </span>
                                      <span class="message text-success">
                                      {{strlen($item->subject) > 15 ? substr($item->subject,0,30)."..." : $item->subject}}
                                      </span>
                                  </a>
                </li>
                @endforeach
                @endisset
                <li>
                  <a href="{{route('message')}}">See all messages</a>
                  <li><a class="" href="{{route('emails')}}">Mail List</a></li>
                </li>
              </ul>
            </li>
            <!-- inbox notificatoin end -->
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
          <li class="active">
            <a class="" href="index.html">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_group"></i>
                          <span>Users</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route('user.index')}}">View Users</a></li>
              <li><a class="" href="{{route('user.create')}}">Create User</a></li>
            </ul>
          </li>
          {{-- api account --}}
          <li class="active">
              <a class="" href="{{route('apiaccount.index')}}">
                            <i class="icon_lifesaver"></i>
                            <span>Api Accounts</span>
                        </a>
            </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>Movies</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route('movie.index')}}">View Movies</a></li>
              <li><a class="" href="{{route('movie.create')}}">Create Movie</a></li>
              <li><a class="" href="{{route('movie.createbyurl')}}">Create Movie By Url</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_grid-2x2"></i>
                          <span>Category</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route('category.index')}}">Categories</a></li>
              <li><a class="" href="{{route('category.create')}}">Create Category</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_pin_alt"></i>
                          <span>Country</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="{{route('country.index')}}">Countries</a></li>
              <li><a class="" href="{{route('country.create')}}">Create Country</a></li>
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
                <li><a class="" href="{{route('episode.multiepisodes')}}">Create Multi Episodes</a></li>
              </ul>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_currency_alt "></i>
                            <span>Advertisement</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a> 
              <ul class="sub">
                <li><a class="" href="{{route('advirtisement.index')}}">ADS</a></li>
                <li><a class="" href="{{route('advirtisement.create')}}">Create ADS</a></li>
              </ul>
            </li>
           
            {{-- open str  --}}
            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_comment"></i>
                            <span>Remote upload</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('remote.index')}}">openload</a></li>
                <li><a class="" href="{{route('remote.create')}}">videos add</a></li>
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
<script>$( document ).ready(function() {
  $('.alert-success').fadeOut(7000);
});</script>
  @yield('footer')
</body>

</html>
