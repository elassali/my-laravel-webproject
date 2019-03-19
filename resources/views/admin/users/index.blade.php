@extends('layouts.AdminMaster')


@section('content')

<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_image"></i> Image</th>
                <th><i class="icon_id-2"></i> Name</th>
                <th><i class="icon_shield_alt"></i> Role</th>
                <th><i class="icon_mail_alt"></i> Email</th>
                <th><i class="icon_hourglass"></i> Created</th>
                <th><i class="icon_hourglass "></i> Updated</th>
                <th><i class="icon_cogs"></i> Action</th>
              </tr>
              @foreach ($user as $user)
              <tr>
              <td ><img class="img-circle" height="50" width="50" src="{{$user->photo ? $user->photo->file.$user->photo->path : 'img/avatar1.jpg' }}"  alt=""></td>
                <td>{{$user->name}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['UserController@destroy',$user->id]] )!!}
                  <div class="btn-group">
                  <a class="btn btn-primary" href="{{route('user.edit',$user->id)}}"><i class="icon_pencil-edit"></i></a>                 
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
@endsection

@section('footer')
<script src="{{asset('js/href_delete.js')}}"></script> 
@endsection