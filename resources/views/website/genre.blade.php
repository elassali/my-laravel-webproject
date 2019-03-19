@extends('layouts.webmaster')
@section('content')
<div class="general-agileits-w3l">
    <div class="w3l-medile-movies-grids">

            <!-- /movie-browse-agile -->
            
                  <div class="movie-browse-agile">
                     <!--/browse-agile-w3ls -->
                    <div class="browse-agile-w3ls general-w3ls">
                            <div class="tittle-head">
                                <h4 class="latest-text"> Movies </h4>
                                <div class="container">
                                    <div class="agileits-single-top">
                                        <ol class="breadcrumb">
                                          <li><a href="index.html">Home</a></li>
                                          <li>{{$page}}</li>
                                          @if ($page==='Country')
                                          <li class="active">{{$country}}</li>
                                          @else
                                          <li class="active">{{$category->name}}</li>
                                          @endif
                                        </ol>
                                    </div>
                                </div>
                            </div>
                                 <div class="container">
                        <div class="browse-inner">
                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~start~~~~~~~~~~~~~~!-->
                            @foreach ($movie as $item)
                                
                           
                            @php
                            $counter++;
                             @endphp
                                           <div class="col-md-2 w3l-movie-gride-agile">
                                               <a href="{{route('watch',['id'=>$item->slug])}}" class="hvr-shutter-out-horizontal"><img   src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}"  title="album-name" style="height: 268px; width:182px;" alt=" " />
                                                   <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                               </a>
                                               <div class="mid-1 agileits_w3layouts_mid_1_home">
                                                   <div class="w3l-movie-text">
                                                       <h6><a href="{{route('watch',['id'=>$item->slug])}}">{{ucfirst($item->name)}}</a></h6>	 						
                                                   </div>
                               
                                               </div>
                                               <div class="ribben">
                                                   <i class="fa fa-star gold" aria-hidden="true"><span></span> {{$item->rate}} </span></i>
                                               </div>
                                           </div>
                                           @if($counter%6==0)
                                           <div class="clearfix"></div>
                                           @endif
                                    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~end~~~~~~~~~~~~~~~~~~~~~~~~~~~~!-->
                                    @endforeach
                            </div>
                </div>
            <!--//browse-agile-w3ls -->
                    <div class="blog-pagenat-wthree">
                      {{$movie->links()}}
                    </div>
                </div>

            </div>
        </div>
@endsection