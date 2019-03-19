@extends($role) 
@section('content')
{{-- Movies --}}
<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_image"></i> Image</th>
                <th><i class="icon_id-2"></i> Uploaded by</th>
                <th><i class="icon_shield_alt"></i> Movie Title</th>
                <th><i class="icon_pin_alt"></i> Country</th>
                <th><i class="icon_clock_alt"></i> Production Year</th>
                <th><i class="icon_ribbon_alt"></i> IMBD Rate</th>
                <th><i class="icon_hourglass"></i> Created at</th>
                <th><i class="icon_hourglass "></i> Updated at</th>
                <th><i class="icon_cogs"></i> Action</th>
              </tr>
              @foreach ($movies as $movie) 
              <tr>
              <td ><img class="img-circle" height="50" width="50" src="{{$movie->photo ? $movie->photo->file.$movie->photo->path : 'img/avatar1.jpg' }}"  alt=""></td>
                <td class="text-center">{{$movie->user->name}}</td>
                <td class="text-center">{{$movie->name}}</td>
                <td class="text-center">{{$movie->country->name}}</td>
                <td class="text-center">{{$movie->year}}</td>
                <td class="text-center">{{$movie->rate}}</td>
                <td class="text-center">{{$movie->created_at->diffForHumans()}}</td>
                <td class="text-center">{{$movie->updated_at->diffForHumans()}}</td>
                <td class="text-center">
                    {!! Form::open(['method'=>'DELETE','action'=>['Movie_Controller@destroy',$movie->id]])!!}
                  <div class="btn-group">
                      <a class="btn btn-primary" target="_blank" href="{{route('watch',['id'=>$movie->slug])}}"><i class="fa fa-eye"></i></a>                 
                  <a class="btn btn-primary" href="{{route('movie.edit',$movie->id)}}"><i class="icon_pencil-edit"></i></a>                 
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="icon_close_alt2"></i></button>  
                  </div>
                  {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
  
            </tbody>
          </table>
        </section>
      </div>
    </div>
</div>
<div class="blog-pagenat-wthree text-center">    
    {{$movies->links()}}
</div>
{{-- Series --}}
<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_image"></i> Image</th>
                <th><i class="icon_id-2"></i> Uploaded by</th>
                <th><i class="icon_shield_alt"></i> Serie Title</th>
                <th><i class="icon_pin_alt"></i> Country</th>
                <th><i class="icon_clock_alt"></i> Production Year</th>
                <th><i class="icon_ribbon_alt"></i> IMBD Rate</th>
                <th><i class="icon_hourglass"></i> Created at</th>
                <th><i class="icon_hourglass "></i> Updated at</th>
                <th><i class="icon_cogs"></i> Action</th>
              </tr>
              @foreach ($series as $serie)
              <tr>
              <td ><img class="img-circle" height="50" width="50" src="{{$serie->photo ? $serie->photo->file.$serie->photo->path : 'img/avatar1.jpg' }}"  alt=""></td>
                <td class="text-center">{{$serie->user->name}}</td>
                <td class="text-center">{{$serie->name}}</td>
                <td class="text-center">{{$serie->country->name}}</td>
                <td class="text-center">{{$serie->year}}</td>
                <td class="text-center">{{$serie->rate}}</td>
                <td class="text-center">{{$serie->created_at->diffForHumans()}}</td>
                <td class="text-center">{{$serie->updated_at->diffForHumans()}}</td>
                <td class="text-center">
                    {!! Form::open(['method'=>'DELETE','action'=>['SerieController@destroy',$serie->id]])!!}
                  <div class="btn-group">
                  <a class="btn btn-primary" href="{{route('serie.edit',$serie->id)}}"><i class="icon_pencil-edit"></i></a>                 
                    {{-- <a class="btn btn-danger" href="{{route('user.destroy',$user->id)}}"  ><i class="icon_close_alt2"></i></a> --}}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="icon_close_alt2"></i></button>  
                  </div>
                  {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
  
            </tbody>
          </table>
        </section>
      </div>
    </div>
</div>
<div class="blog-pagenat-wthree text-center">    
  {{$series->links()}}
</div>
{{-- Episodes --}}
<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_image"></i> Image</th>
                <th><i class="icon_film"></i> Serie Title</th>
                <th><i class="icon_documents"></i> Season</th>
                <th><i class="social_youtube_square"></i> Episode</th>
                <th><i class="icon_cogs"></i> Action</th>
              </tr>
              @foreach ($watchs as $watch)
              <tr>
              <td ><img class="img-circle" height="50" width="50" src="{{$watch->serie->photo ? 'img/'.$watch->serie->photo->path : 'img/avatar1.jpg' }}"  alt=""></td>
                <td class="text-center">{{$watch->serie->name}}</td>
                <td class="text-center">{{$watch->season->season_number}}</td>
                <td class="text-center">{{$watch->episode_number}}</td>
                <td class="text-center">
                    {!! Form::open(['method'=>'DELETE','action'=>['EpisodeController@destroy',$watch->id]])!!}
                  <div class="btn-group">
                      <a class="btn btn-primary" target="_blank" href="{{route('watchserie',['idepisode'=>$watch->id,'idserie'=>$watch->serie_id,'idseason'=>$watch->season_id])}}"><i class="fa fa-eye"></i></a> 
                  <a class="btn btn-primary" href="{{route('episode.edit',$watch->id)}}"><i class="icon_pencil-edit"></i></a>                 
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="icon_close_alt2"></i></button>  
                  </div>
                  {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
  
            </tbody>
          </table>
        </section>
      </div>
    </div>
</div>
<div class="blog-pagenat-wthree text-center">    
     {{$watchs->links()}}
</div>
@endsection

@section('footer')
<script src="{{asset('js/href_delete.js')}}"></script> 
@endsection