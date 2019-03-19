@extends('layouts.webmaster')
@section('content')
<div class="general_social_icons">
	<nav class="social">
		<ul>
			<li class="w3_facebook"><a href="#" target="_black">Facebook <i class="fa fa-facebook"></i></a></li>
		</ul>
  </nav>
</div>
<div id="slidey" style="display:none;">
    <ul>
     @foreach ($movie_owl as $movie_owl)
     
     <li>  
        
         <img  src=" {{$movie_owl->photo ? $movie_owl->photo->file.$movie_owl->photo->pathcr : 'img/avatar1.jpg' }}" alt="" />
        
        
          <p class='title'> <a href="{{route('watch',['id'=>$movie_owl->slug])}}">{{ucwords($movie_owl->name)}}</a></p> 
        
              <p class='description'>{{ucfirst($movie_owl->story)}}</p> 
           
     </li>
    
     @endforeach
    </ul>   	
</div>
<script src="js/jquery.slidey.js"></script>
<script src="js/jquery.dotdotdot.min.js"></script>
   <script type="text/javascript">
        $("#slidey").slidey({
            interval: 5000,
            listCount: 5,
            autoplay: false,
            showList: true
        });
        $(".slidey-list-description").dotdotdot();
    </script>
<!-- //banner -->
<div class="general">
    <h4 class="latest-text w3_latest_text"> Movies</h4>
    <div class="container">
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Featured</a></li>
                <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Top viewed</a></li>
                <li role="presentation"><a href="#rating" id="rating-tab" role="tab" data-toggle="tab" aria-controls="rating" aria-expanded="true">Top Rated</a></li>
                <li role="presentation"><a href="#imdb" role="tab" id="imdb-tab" data-toggle="tab" aria-controls="imdb" aria-expanded="false">Recently Added</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                    <div class="w3_agile_featured_movies">
                        <!-- start !-->
                        @php
                                $counter=0;
                                 @endphp   
         @foreach ($movie_featured as $item)
                            
         @php
         $counter++;
          @endphp
                        <div class="col-md-2 w3l-movie-gride-agile">
                            <a href="{{route('watch',['id'=>$item->slug])}}" class="hvr-shutter-out-horizontal">
                                <img class="img-responsive" src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}"  title="{{ucfirst($item->name)}}" alt="{{ucfirst($item->name)}}" />
                                <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                <div class="ribbon" ><span>{{$item->quality}}</span></div>
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
        @endforeach             
                        <!--  END!-->
                    </div>
                </div>


                <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <!-- start!-->
                              @php
                                $counter=0;
                                 @endphp   
             @foreach ($movie_toview as $item)
             @php
             $counter++;
              @endphp
                    <div class="col-md-2 w3l-movie-gride-agile">
                            <a href="{{route('watch',['id'=>$item->slug])}}" class="hvr-shutter-out-horizontal"><img class="img-responsive" src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}"  title="{{ucfirst($item->name)}}"  alt="{{ucfirst($item->name)}}" />
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
             @endforeach         
             </div>
 
                                <!-- END !-->
                            <div role="tabpanel" class="tab-pane fade" id="rating" aria-labelledby="rating-tab">
                                <!-- Start !-->             
                                @php
                                $counter=0;
                                 @endphp     
                                @foreach ($movie_imbd as $item)
                                @php
                                $counter++;
                                 @endphp
                                    <div class="col-md-2 w3l-movie-gride-agile">
                                        <a href="{{route('watch',['id'=>$item->slug])}}" class="hvr-shutter-out-horizontal"><img class="img-responsive" src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}"  title="{{ucfirst($item->name)}}"  alt="{{ucfirst($item->name)}}" />
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
                                @endforeach
                            </div>
                        
                            <div role="tabpanel" class="tab-pane fade" id="imdb" aria-labelledby="imdb-tab">
                                    <!-- Start !-->
                                    @php
                                $counter=0;
                                 @endphp   
                                    @foreach ($movie_recently as $item)
                                    @php
                                    $counter++;
                                     @endphp
                                        <div class="col-md-2 w3l-movie-gride-agile">
                                            <a href="{{route('watch',['id'=>$item->slug])}}" class="hvr-shutter-out-horizontal"><img class="img-responsive" src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}"  title="{{ucfirst($item->name)}}" alt="{{ucfirst($item->name)}}" />
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
                                    @endforeach
                                </div>
            </div>
        </div>
    </div>
</div>
<!-- //general -->

@endsection