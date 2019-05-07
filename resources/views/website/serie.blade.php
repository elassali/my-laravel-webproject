@extends('layouts.webmaster')
{{-- @section('metashare')
<meta property="og:url"           content="{{route('watch',['id'=>$watch->slug])}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Your Website Title" />
<meta property="og:description"   content="Your description" />
<meta property="og:image"         content="https://i.imgur.com/xo9xqjG.jpg" />
@endsection --}}
@section('content')
<div class="single-page-agile-main">
        <div class="container">
                <!-- /w3l-medile-movies-grids -->
                    <div class="agileits-single-top">
                        <ol class="breadcrumb">
                          <li><a href="{{route('index')}}">Home</a></li>
                          <li>Watch</li>
                          <li class="active">{{$watch->serie->name}}</li>
                        </ol>
                     </div>
                     <div class="single-page-agile-info">
                           <!-- /movie-browse-agile -->
                           <div class="cont">
                                   <div class="show-top-grids-w3lagile">
                        <div class="col-sm-12 single-left">
                            <div class="song">
                                <div class="song-info text-center">
                                <h3> Season {{$watch->season->season_number}} - Trailer </h3> 	
                               </div>
                                <div class="video-grid-single-page-agileits">
                                   
                                    <div class="col-md-12 resp-container" style="margin-left:8px;">
                                        <iframe class="resp-iframe" src="{{$watch->season->trailer}}" gesture="media"  allow="encrypted-media" allowfullscreen></iframe>
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
                                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Watch</a></li>
                                    <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Download</a></li>
                                    <li role="presentation"><a href="#rating" id="rating-tab" role="tab" data-toggle="tab" aria-controls="rating" aria-expanded="true">Seasons</a></li>
                                    <li role="presentation"><a href="#imdb" role="tab" id="imdb-tab" data-toggle="tab" aria-controls="imdb" aria-expanded="false">Episodes</a></li>
                                </ul>
                                <div class="alert alert-info alert-dismissible" style="margin-top:10px;">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Please Report!</strong> Any episode if all watching servers dose not working using contact us page
                                        and we will fix it as soon as possible.
                                         {{-- report button --}}
                                      <a href="/contact" class="btn btn-warning btn-sm active"   style="float:right; ">
                                            <i class="fa fa-exclamation-triangle"></i>  Report
                                            </a>
                                            {{-- end report button --}}
                                      </div>  
                                       
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                                        <div class="w3_agile_featured_movies">
                                            <?php 
                                            $videospider_ticket = file_get_contents('https://videospider.in/getticket.php?key=Psb7KFo1qo1ZtVSk&secret_key=6te8vjvjm9t94mlp6wi9mfruvo58cl&video_id='.$watch->server1.'&s='.$watch->season->season_number.'&ip='.$_SERVER["REMOTE_ADDR"]);
                                            ?>
                                            <div class="col-md-12 resp-container" >
                                            <iframe class="resp-iframe videostream" 
                                            src="https://videospider.stream/getvideo?key=Psb7KFo1qo1ZtVSk&video_id={{$watch->server1}}&tv=1&s={{$watch->season->season_number}}&e={{$watch->episode_number}}&ticket=<?php echo $videospider_ticket; ?>" 
                                                gesture="media"  allow="encrypted-media" allowfullscreen></iframe>
                                            </div>
                                            {{-- Facebook share button --}}
                                            <div class="fb-share-button" 
                                               data-href="{{route('watchserie',['idepisode'=>$watch->slug])}}" 
                                                data-layout="button_count" data-size="large">
                                           </div>
                                           @include('layouts.disquecomment')
                                        </div>
                                        
                                        <script>(function(d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) return;
                                            js = d.createElement(s); js.id = id;
                                            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
        
                                        <!-- Your share button code -->
                                        
                                        
                                    </div>
                                   
                                    <div role="tabpanel" class="tab-pane fade" id="rating" aria-labelledby="rating-tab"> 
                                        {{-- <p>Seasons</p>  --}}
                                @foreach ($season as $item)

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
                                    
                                         @endforeach 
    
                                    </div>   

                                    <div role="tabpanel" class="tab-pane fade" id="imdb" aria-labelledby="imdb-tab"> 
                                            {{-- <p>Episodes</p> --}}
                                            <div id="episodes">
                                                    <div class="col-md-2 forlistserver" id="season">						
                                                            <ul class="list-group">
                                                                @foreach ($season as $item)
                                                            <li class="list-group-item" >  <a data-season="{{$item->id}}" class="list-group-item list-group-item-action list-group-item-light" > Season <strong>{{$item->season_number}}</strong></a></li>

                                                                @endforeach
                                                                    
                                                             </ul>
                                                      </div>
                                            
                                                      
                                                      <div class="autoloadepi"> 
                                                     @foreach ($episodes as $item)
                                                         
                                                      <div class="col-md-1 forep">
                                                            <div class="squar">
                                                                <a  href="{{route('watchserie',['idepisode'=>$item->slug])}}">
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
                        </div>
                                                        
                            <script>
                                   $(document).ready(function(){
                                       $(".watchserie").children().click(function()
                                       {
                                           $(this).find("a").removeClass('active');
                                       });
        
                                        $(".watchserie").on('click','li',function()
                                        {
                                         $(this).find("a").toggleClass('active');
                                         var link=$(this).find("a").data('server');
                                         $(".videostream").attr('src',link);
        
                                        });
                                   });
                               </script>
                <script>
                    $(function() {  
                          $("#forlistserver").niceScroll();
                     });
                    </script>
               <script>
                    $(document).ready(function()
                    {
                        $("#season").on('click','li',function()
                        {
                        var season_id = $(this).find("a").data('season');           
                        var selection = $('.autoloadepi');
                        var serie_id = {{$watch->serie->id}};
                        var op="";
        
                        $.ajax({
                                  type:'get',
                                  url:'{!!URL::to('loadepisode')!!}',
                                  data:{'id':season_id,'srid':serie_id},
                                  dataType: 'json',
                                  success:function(data)
                                  {
                                
                                    for(var i=0;i<data[0].length;i++)
                                    {
                                      op+='<div class="col-md-1 forep"><div class="squar" style="display:none;"> <a  href="/watchserie/'+data[0][i].slug+'"> <h1 class="child1">'+data[0][i].episode_number+'</h1><span class="child2">Episodes</span></a></div></div>';
                                    }
                                    selection.html("");
                                    selection.append(op);
                                  },
                                  error:function(data)
                                  {
                                  }
                        }).done(function(){$(".squar").fadeIn(1500);});
                       
                      });
                    });
                    
                
                </script>


@endsection