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
                <td>{{$serie->user->name}}</td>
                <td>{{$serie->name}}</td>
                <td>{{$serie->country->name}}</td>
                <td>{{$serie->year}}</td>
                <td>{{$serie->rate}}</td>
                <td>{{$serie->created_at->diffForHumans()}}</td>
                <td>{{$serie->updated_at->diffForHumans()}}</td>
                <td>
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
@endsection

@section('footer')
<script src="{{asset('js/href_delete.js')}}"></script> 
@endsection