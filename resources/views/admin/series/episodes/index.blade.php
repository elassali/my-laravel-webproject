@extends($role)
@section('content')

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
                <td>{{$watch->serie->name}}</td>
                <td>{{$watch->season->season_number}}</td>
                <td>{{$watch->episode_number}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['EpisodeController@destroy',$watch->id]])!!}
                  <div class="btn-group">
                      <a class="btn btn-primary" target="_blank" href="{{route('watchserie',['idserie'=>$watch->serie->slug ,'idseason'=>$watch->season->slug ,'idepisode'=>$watch->slug])}}"><i class="fa fa-eye"></i></a> 
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