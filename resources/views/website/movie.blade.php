@extends('layouts.webmaster')
{{-- @section('metashare')
<meta property="og:url"           content="{{route('watch',['id'=>$movie->slug])}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Your Website Title" />
<meta property="og:description"   content="Your description" />
<meta property="og:image"         content="images/titlecon.png" />
@endsection --}}
@section('content')
<div class="single-page-agile-main">
    <div class="container">
            <?php var_dump($valideurlss) ?>
            <!-- /w3l-medile-movies-grids -->
                <div class="agileits-single-top">
                    <ol class="breadcrumb">
                      <li><a href="{{route('index')}}">Home</a></li>
                      <li>Watch</li>
                      <li class="active">{{strtoupper($movie->name)}}</li>
                    </ol>
                 </div>
                 <div class="single-page-agile-info">
                       <!-- /movie-browse-agile -->
                       <div class="cont">
                               <div class="show-top-grids-w3lagile">
                    <div class="col-sm-6 single-left">
                        <div class="song">
                            <div class="song-info text-center">
                                <h3>{{strtoupper($movie->name)}} - Trailer </h3> 	
                           </div>
                            <div class="video-grid-single-page-agileits">
                                <div id="video">
                                    <iframe width="560" height="250" src="{{$movie->trailer}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                 </div>
                            </div>
                        </div>
                        
                        
                        <div class="clearfix"> </div>					
                    </div>
                    <div class="col-md-6 single-right">
                        <h3>Story</h3>
                        <div class="single-grid-right">
                            <div class="single-right-grids">							
                            <p class="views">{{$movie->story}}</p>
                                <div class="clearfix"> </div>
                            </div>					
                        </div>
                    </div>				
                    <div class="clearfix"> </div>  
                </div>
                </div>
            </div> 
           
        </div>    
        
        <div class="clearfix"> </div>  
    
                    <!-- //movie-browse-agile -->
                   <div class="general">
				<div class="container">
                        <div class="alert alert-info alert-dismissible" style="margin-top:10px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Please Report!</strong> Any movie if all watching servers dose not working using contact us page
                                and we will fix it as soon as possible.
                                 {{-- report button --}}
                              <a href="/contact" class="btn btn-warning btn-sm active"   style="float:right; ">
                                    <i class="fa fa-exclamation-triangle"></i>  Report
                                    </a>
                                    {{-- end report button --}}
                              </div> 
                               
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Watch</a></li>
							<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Download</a></li>
                        </ul>
						
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
								<div class="w3_agile_featured_movies">
									<div class="col-sm-12 resp-container" >
                                 @if(empty($valideurls))
                                    <iframe class="resp-iframe" 
                                    src="https://videospider.stream/getvideo?key=Psb7KFo1qo1ZtVSk&video_id={{$movie->watch->server1}}&ticket=<?php echo $videospider_ticket;?>" 
                                        gesture="media"  allow="encrypted-media" allowfullscreen>
                                    </iframe>
                                 @else
                                    <iframe class="resp-iframe" 
                                              src="{{ $valideurls }}" 
                                               gesture="media"  allow="encrypted-media" allowfullscreen>
                                    </iframe>                                        
                                 @endif

                                    </div>                       
                            </div>
                                 <!-- Your share button code -->
                                 <div class="fb-share-button" 
                                 data-href="{{route('watch',['id'=>$movie->slug])}}" 
                                 data-layout="button_count" data-size="large">                                                               
                                 </div>
                               
                                 @include('layouts.disquecomment')   
                                                        
                              
                            </div>
                           
                                           
		
							<div role="tabpanel" class="tab-pane fade" id="profile"  aria-labelledby="profile-tab"> 
								<div id="downl">
									<ul class="list-group">
                                            @if(!is_null($movie->download->server1)) 
											<div class="col-md-3">
                                            <li class="list-group-item list-group-item-success"><a href="{{$movie->download->server1}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true" target="_blank"><i class="fa fa-download"></i> Server One</a></li>
                                               
                                             </div>
                                             @endif
                                             @if(!is_null($movie->download->server2)) 
											 <div class="col-md-3">
													<li class="list-group-item list-group-item-success"><a href="{{$movie->download->server2}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true" target="_blank"><i class="fa fa-download"></i> Server Two</a></li>
                                            </div>
                                            @endif

                                            @if(!is_null($movie->download->server3)) 
													 <div class="col-md-3">
														<li class="list-group-item list-group-item-success"><a href="{{$movie->download->server3}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true" target="_blank"><i class="fa fa-download"></i> Server Three</a></li>
                                                    </div>
                                                     @endif
                                                     @if(!is_null($movie->download->server4))
													 <div class="col-md-3">
														<li class="list-group-item list-group-item-success"><a href="{{$movie->download->server4}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true" target="_blank"><i class="fa fa-download"></i> Server Four</a></li>
                                                     </div>
                                                     @endif
                                                     @if(!is_null($movie->download->server5)) 
												 <div class="col-md-3">
													<li class="list-group-item list-group-item-success"><a href="{{$movie->download->server5}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true" target="_blank"><i class="fa fa-download"></i> Server Five</a></li>
                                                 </div>
                                                 @endif
                                                 @if(!is_null($movie->download->server6)) 
												 <div class="col-md-3">
												  <li class="list-group-item list-group-item-success"><a href="{{$movie->download->server6}}" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true" target="_blank"><i class="fa fa-download"></i> Server Six</a></li>
                                                 </div>
                                                 @endif
			 
									</ul>    
							</div>
							</div>
		
						</div>
					</div>
				</div>
                                                
                    <script>
                           $(document).ready(function(){
                               $(".forlistserver").children().click(function()
                               {
                                   $(this).find("a").removeClass('active');
                               });

                                $(".forlistserver").on('click','li',function()
                                {
                                 $(this).find("a").toggleClass('active');
                                 var link=$(this).find("a").data('server');
                                 $(".resp-iframe").attr('src',link);

                                });
                           });
                       </script>
                       <script>
                       $(function() {  
                             $("#forlistserver").niceScroll();
                        });
                       </script>
                       {{-- facebook share button script --}}
                       <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                     
                       
                    
                         
     
@endsection