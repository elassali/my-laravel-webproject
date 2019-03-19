@extends($role)
@section('content')

<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_image"></i> Image</th>
                <th><i class="icon_shield_alt"></i> Serie Title</th>
                <th><i class="icon_pin_alt"></i> Season</th>
                <th><i class="icon_cogs"></i> Action</th>
              </tr>
              @foreach ($seasons as $season)
              <tr>
              <td ><img class="img-circle" height="50" width="50" src="{{$season->serie->photo ? 'img/'.$season->serie->photo->path : 'img/avatar1.jpg' }}"  alt=""></td>
                <td>{{$season->serie->name}}</td>
                <td>{{$season->season_number}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['SeasonController@destroy',$season->id]])!!}
                  <div class="btn-group">
                  <a class="btn btn-primary" href="{{route('season.edit',$season->id)}}"><i class="icon_pencil-edit"></i></a>                 
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
    {{$seasons->links()}}
</div>
@endsection

@section('footer')
<script src="{{asset('js/href_delete.js')}}"></script> 
@endsection