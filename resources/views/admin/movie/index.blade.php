@extends($role)
@section('content')

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
                <td>{{$movie->user->name}}</td>
                <td>{{$movie->name}}</td>
                <td>{{$movie->country->name}}</td>
                <td>{{$movie->year}}</td>
                <td>{{$movie->rate}}</td>
                <td>{{$movie->created_at->diffForHumans()}}</td>
                <td>{{$movie->updated_at->diffForHumans()}}</td>
                <td>
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
@endsection

@section('footer')
<script src="{{asset('js/href_delete.js')}}"></script> 
@endsection