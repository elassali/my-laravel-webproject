@extends('layouts.webmaster')
@section('content')
<div class="general-agileits-w3l">
    <div class="w3l-medile-movies-grids">

            <!-- /movie-browse-agile -->
            
                  <div class="movie-browse-agile"> 
                     <!--/browse-agile-w3ls -->
                    <div class="browse-agile-w3ls general-w3ls">
                            <div class="tittle-head">
                                <h4 class="latest-text">Search Result </h4>
                                <div class="container">
                                    <div class="agileits-single-top">
                                        <ol class="breadcrumb">
                                          <li><a href="{{route('index')}}">Home</a></li>
                                          <li>Search</li>
                                          <li class="active">{{$request['title']}}</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                                 <div class="container">
                        <div class="browse-inner">
                            @if ($movie->isEmpty() && $season->isEmpty())
                                <h1 class="text-center">No result found</h1>
                            @endif
                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~start~~~~~~~~~~~~~~!-->
                            @foreach ($movie as $item)
                                  
                            @php
                            $counter++;
                             @endphp
                                           <div class="col-md-2 w3l-movie-gride-agile">
                                               <a href="{{route('watch',['id'=>$item->slug])}}" class="hvr-shutter-out-horizontal"><img   src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}"  title="album-name" style="height: 268px; width:182px;" alt=" " />
                                                   <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                                   <div class="ribbon" ><span>{{$item->quality}}</span></div>                                   
                                                  <div class="ribban" > <i class="fa fa-star" aria-hidden="true"><span></span> {{$item->rate}} </span></i></div>
                                               </a>
                                               <div class="mid-1 agileits_w3layouts_mid_1_home">
                                                   <div class="w3l-movie-text">
                                                       <h6><a href="{{route('watch',['id'=>$item->slug])}}">{{$item->name}}</a></h6>							
                                                   </div>
                               
                                               </div>
                                       
                                           </div>
                                           @if($counter%6==0)
                                           <div class="clearfix"></div>
                                           @endif
                                    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~end~~~~~~~~~~~~~~~~~~~~~~~~~~~~!-->
                                    @endforeach

                                    @foreach ($season as $item)  
                                    @php
                                    $counter++;
                                     @endphp           
                                 <div class="col-md-2 w3l-movie-gride-agile">
                                                        <a href="{{route('season',['slugseason'=>$item->slug])}}" class="hvr-shutter-out-horizontal"><img src="{{$item->serie->photo->file.$item->serie->photo->path}}" title="album-name" style="height: 268px; width:182px;" alt=" " />
                                                                    <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                                                </a>
                                                                <div class="mid-1 agileits_w3layouts_mid_1_home">
                                                                    <div class="w3l-movie-text">
                                                                    <h3><a href="{{route('season',['slugseason'=>$item->slug])}}">Season {{$item->season_number}}</a></h3>							
                                                                    </div>                                                         
                                                                </div>
                                                               
                                    </div>
                                @if($counter%6==0)
                                <div class="clearfix"></div>
                                @endif
                              @endforeach
                            </div>
                </div>
            <!--//browse-agile-w3ls -->
                    
                </div>

            </div>
        </div>
@endsection