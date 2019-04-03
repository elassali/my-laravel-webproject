@extends('layouts.webmaster')
@section('content')
<div class="general">
    <h4 class="latest-text w3_latest_text">Tv-Series</h4>
    <div class="container">
        
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                    <div class="w3_agile_featured_movies"> 
                                             
                        @foreach ($serie as $item)              
                                <div class="col-md-2 w3l-movie-gride-agile">
                                        
                                    <a href="{{route('watchserie',['idserie'=>$item->serie->slug ,'idseason'=>$item->season->slug ,'idepisode'=>$item->slug])}}" class="hvr-shutter-out-horizontal">                                                           
                                   <img src="{{$item->serie->photo->file.$item->serie->photo->path}}" title="{{ucfirst($item->serie->name)}}" class="img-responsive" alt="{{$item->serie->slug}}" />                         
                                    <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                    <div class="ribbon"><span>SE{{$item->season->season_number}} EP{{$item->episode_number}}</span></div>
                                    <div class="ribban" > <i class="fa fa-star" aria-hidden="true"><span></span>  {{$item->serie->rate }} </span></i></div>
                                    </a> 
                                    <div class="mid-1 agileits_w3layouts_mid_1_home">
                                        <div class="w3l-movie-text">
                                        <h4><a href="{{route('watchserie',['idserie'=>$item->serie->slug ,'idseason'=>$item->season->slug ,'idepisode'=>$item->slug])}}">{{ucfirst($item->serie->name)}}</a></h4>							
                                        </div>
                                        
                                    </div>
                                </div>
                         @endforeach
                    </div>
                </div> 
 
        </div>
    </div>
</div>
<!-- //general -->
<div class="blog-pagenat-wthree">    
    {{$serie->render()}}
</div>

@endsection