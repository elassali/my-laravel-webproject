<!DOCTYPE html>
<html lang="en">
<head>
		
	<title>{{ MetaTag::get('title') }}</title>

	{{-- {!! MetaTag::tag('titlecon.png') !!} --}}

	{!! MetaTag::openGraph() !!}

	{!! MetaTag::twitterCard() !!}

	<link rel="shortcut icon" type="image/x-icon" href="{!! MetaTag::set('image', asset('images/titlecon.png')) !!}" />
		 {{-- og properties --}}
		<meta property="og:image"   content="{!! MetaTag::get('image', asset('images/titlecon.png')) !!}" />
				<meta property="og:image:width" content="200" />
			<meta property="og:image:height" content="300" />
	{{-- ---------------------------- to edit later share image button --}}


<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="/css/contactstyle.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/faqstyle.css" type="text/css" media="all" />
<link href="/css/single.css" rel='stylesheet' type='text/css' />
<link href="/css/medile.css" rel='stylesheet' type='text/css' />
<!-- banner-slider -->
<link href="/css/jquery.slidey.min.css" rel="stylesheet">
<!-- //banner-slider -->
<!-- pop-up -->
<link href="/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<!-- //pop-up -->
<!-- font-awesome icons -->
<link rel="stylesheet" href="/css/font-awesome.min.css" />
<!-- //font-awesome icons -->
<!-- js -->
<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- banner-bottom-plugin -->
<link href="/css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
<script src="/js/owl.carousel.js"></script>
<script>
	$(document).ready(function() { 
		$("#owl-demo").owlCarousel({
	 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
	 
		  items : 5,
		  itemsDesktop : [640,4],
		  itemsDesktopSmall : [414,3]
	 
		});
	 
	}); 
</script> 
<!-- //banner-bottom-plugin -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="/js/move-top.js"></script>
<script type="text/javascript" src="/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
{{-- start meta share button --}}
@yield('metashare')

</head>
	
<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="w3layouts_logo">
				<a href="{{route('index')}}"><h1>Fresh<span>Movies4U</span></h1></a>
			</div>
			<div class="w3_search">
				{!! Form::open(['method'=>'GET','route' => ['search'],'id'=>'searchit']) !!}
				   <input type="text" name="title" id="title" placeholder="Search" autocomplete="off" required="">
					<input type="submit" value="Go">					
					{!! Form::close() !!}
					<div class="dropdown " id="dropdown">
					<ul id="suggestion"  class="dropdown-menu" style="width:100%; max-height:400px;">
					
					
					</ul>

					</div>
				</div>
{{-- searsh script --}}
				<script>
					$(document).ready(function(){					

				$('#title').keyup(function(){
					$('#dropdown').show();
						  var query = $(this).val();
						  var _token = $('input[name="_token"]').val();
						 if(query === '' || query === null)
						  {
							$('#suggestion').hide();
						  }
						$('#suggestion').fadeIn();
						if(query!=='')
						  {						
							 $.ajax({
								url:'{{ route('autocomplete.fetch') }}',
								method:"GET",
								data:{query:query , _token:_token},
								success:function(data)
								{
									if(!$.trim(data))
									{
										$('#dropdown').hide();
									}

								      $('#suggestion').fadeIn();
											$('#suggestion').html(data);

											if($('#suggestion').height()>350)	
											{
												$('#suggestion').css("overflow-y","scroll");
											}
											else{
												$('#suggestion').css("overflow-y","visible");
											}
											console.log(data);
								}, 
								error:function(data)
								{
									console.log('failed');
								}
							 });							
						  }
							if(query === '' || query === null)
						  {
							$('#suggestion').hide();
							$('#dropdown').hide();
						  }
		       	});
				});
            $(document).on('click','.resulta',function(){
							$('#title').val($(this).text().trim());
							$('#suggestion').fadeOut();
							$('#searchit').submit();
						});
						$('#suggestion').hover(function(){

							$('#suggestion').css("cursor","pointer");
						});				
				</script>
			{{-- end searsh script --}}
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- //bootstrap-pop-up -->
<!-- nav -->
	<div class="movies_nav">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
			
				<div class="collapse navbar-collapse navbar-left" id="bs-example-navbar-collapse-1">		
					<nav style="margin-left: 7%;">
						
						<ul class="nav navbar-nav">	
							<li><a href="{{route('index')}}">Home</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Genres <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-3">
									<li>
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li><a href="{{route('genre',['genre'=>'Action'])}}">Action</a></li>
											<li><a href="{{route('genre',['genre'=>'Biography'])}}">Biography</a></li>
											<li><a href="{{route('genre',['genre'=>'Crime'])}}">Crime</a></li>
											<li><a href="{{route('genre',['genre'=>'Family'])}}">Family</a></li>
											<li><a href="{{route('genre',['genre'=>'Horror'])}}">Horror</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li><a href="{{route('genre',['genre'=>'Adventure'])}}">Adventure</a></li>
											<li><a href="{{route('genre',['genre'=>'Comedy'])}}">Comedy</a></li>
											<li><a href="{{route('genre',['genre'=>'Documentary'])}}">Documentary</a></li>
											<li><a href="{{route('genre',['genre'=>'Fantasy'])}}">Fantasy</a></li>
											<li><a href="{{route('genre',['genre'=>'Romance'])}}">Romance</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li><a href="{{route('genre',['genre'=>'Animation'])}}">Animation</a></li>
											<li><a href={{route('genre',['genre'=>'Drama'])}}>Drama</a></li>
											<li><a href={{route('genre',['genre'=>'History'])}}>History</a></li>
											<li><a href="{{route('genre',['genre'=>'Sports'])}}">Sports</a></li>
											<li><a href="{{route('genre',['genre'=>'War'])}}">War</a></li>
										</ul>
									</div>
									<div class="clearfix"></div>
									</li>
								</ul>
							</li>
							<li><a href="{{route('tv-serie')}}">tv - series</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Country <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-3">
									<li>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">												
												<li><a href="{{route('country',['country'=>'USA'])}}">United States</a></li>
												<li><a href="{{route('country',['country'=>'UnitedKingdom'])}}">United Kingdom</a></li>
												<li><a href="{{route('country',['country'=>'Frensh'])}}">Frensh</a></li>
												<li><a href="{{route('country',['country'=>'Spain'])}}">Spain</a></li>
											</ul>
										</div>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												<li><a href="{{route('country',['country'=>'China'])}}">China</a></li>
												<li><a href="{{route('country',['country'=>'Korea'])}}">Korea</a></li>
												<li><a href="{{route('country',['country'=>'Japan'])}}">Japan</a></li>
												<li><a href="{{route('country',['country'=>'Thailand'])}}">Thailand</a></li>
												<li><a href="{{route('country',['country'=>'Asia'])}}">Asia</a></li>

											</ul>
										</div>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												<li><a href="{{route('country',['country'=>'Italy'])}}">Italy</a></li>
												<li><a href="{{route('country',['country'=>'Turkey'])}}">Turkey</a></li>
												<li><a href="{{route('country',['country'=>'India'])}}">India</a></li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</nav>	
		</div>
	</div>
<!-- //nav -->
<!-- banner -->


@yield('content')


<!-- banner-bottom -->
@if(!empty($myvariable))
<div class="banner-bottom">
	<div class="container">
		<div class="w3_agile_banner_bottom_grid">
			<h4 class="latest-text w3_latest_text" style="margin: 0% 0% 2%;">IT MAY INTEREST YOU</h4>
			<div id="owl-demo" class="owl-carousel owl-theme">
       
				<!--start !-->
				@foreach ($ads as $item)
					
				
				<div class="item">
					<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
						<a href="{{$item->adurl}}" target="_blank" class="hvr-shutter-out-horizontal"><img src="{{$item->photo ? $item->photo->file.$item->photo->path : 'img/avatar1.jpg'}}" title="album-name" class="img-responsive" alt=" " />
						</a>
						<div class="mid-1 agileits_w3layouts_mid_1_home">
							<div class="w3l-movie-text">
								<h6><a href="{{$item->adurl}}" target="_blank">{{$item->name}}</a></h6>							
							</div>
						
						</div>
					</div>
				</div>
				<!-- END !-->
				@endforeach
		
			</div>
		</div>			
	</div>
</div>
@endif
<!-- //banner-bottom -->
<!-- Latest-tv-series -->
	 
	<!-- pop-up-box -->  
<!-- //Latest-tv-series -->
<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="w3ls_footer_grid">
				<div class="col-md-6 w3ls_footer_grid_left">
					<div class="w3ls_footer_grid_left1">
						<h2>Subscribe to us</h2>
						<div class="w3ls_footer_grid_left1_pos">

					{!! Form::open(['method'=>'POST','action'=>'indexmoviepage@store']) !!}
								<input type="email" name="email" placeholder="Your email..." required="">
								<input type="submit" value="Send">
					{!! Form::close() !!}

						</div>
					</div>
				</div>
				<div class="col-md-6 w3ls_footer_grid_right">
				<a href="{{route('index')}}"><h2>Fresh<span> Movies4U</span></h2></a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-5 w3ls_footer_grid1_left">
				<p>&copy; 2019 FreshMovies4U. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
			</div>
			<div class="col-md-7 w3ls_footer_grid1_right">
				<ul>
					<li>
						<a href="{{route('index')}}">Movies</a>
					</li>
					
					<li>
						<a href="horror.html">Action</a>
					</li>
					
					<li>
						<a href="comedy.html">Comedy</a>
					</li>		
					<li>
						<a href="{{route('privacy')}}">Privacy Policy</a>
					</li>	
					<li>
					<a href="{{route('contact')}}">Contact Us</a>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>


<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- //Bootstrap Core JavaScript -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="/js/jquery.nicescroll.js"></script>
<script> 
$(function() {  
		$("body").niceScroll();
});
</script>
</body>
</html>