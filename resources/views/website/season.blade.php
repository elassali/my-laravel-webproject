@extends('layouts.webmaster')
@section('content')
<div class="single-page-agile-main">
        <div class="container">
                <!-- /w3l-medile-movies-grids -->
                    <div class="agileits-single-top">
                        <ol class="breadcrumb">
                          <li><a href="{{route('index')}}">Home</a></li>
                          <li>Watch</li>
                          <li class="active">{{$serie->name}}</li>
                        </ol>
                     </div>
                     <div class="single-page-agile-info">
                           <!-- /movie-browse-agile -->
                           <div class="cont">
                                   <div class="show-top-grids-w3lagile">
                        <div class="col-sm-12 single-left">
                            <div class="song">
                                <div class="song-info text-center">
                                <h3> Season {{$season->season_number}} - Trailer </h3> 	
                               </div>
                                <div class="video-grid-single-page-agileits">
                                   
                                    <div class="col-md-12 resp-container" style="margin-left:8px;">
                                        <iframe class="resp-iframe" src="{{$season->trailer}}" gesture="media"  allow="encrypted-media" allowfullscreen></iframe>
                                     </div>
                                    
                                </div>
                            </div>
                            
                            <div class="clearfix"> </div>					
                        </div>
                     				
                        <div class="clearfix"> </div>  
                     </div>
                    </div>
                </div>    
            </div>    
            <div class="clearfix"> </div>  

               

                <div class="general">
                        <div class="container">
                            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Episodes</a></li>
                                   
                                </ul>
                 
                
                              
                           

                                <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">                                            {{-- <p>Episodes</p> --}}
                                            <div id="episodes">
                                                
            
                                                     @foreach ($episodes as $item)
                                                                                                             
                                                      <div class="col-md-1 forep">
                                                            <div class="squar">
                                                                <a  href="{{route('watchserie',['idserie'=>$item->serie->slug ,'idseason'=>$item->season->slug ,'idepisode'=>$item->slug])}}">
                                                                <h1 class="child1">{{$item->episode_number}}</h1>
                                                                    <span class="child2">Episodes</span>
                                                                </a>
                                                            </div>
                                                     </div>
                                                     @endforeach
                                               </div>
                                     </div>   
                
                                </div>
                            </div>
                        </div>
                                                        
                    


@endsection