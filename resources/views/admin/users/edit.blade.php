@extends('layouts.AdminMaster')

@section('content')

<div class="row" style="margin:1px">
 <div class="col-lg-8">
 {{-- {!! Form::model($user['method'=>'PATCH',['action'=>'UserController@update',$user->id],'files' => true]) !!} --}}
{!! Form::model($user, ['method'=>'PATCH','route' => ['user.update', $user->id],'files'=>true])!!}
    

        <div class="form-group">
            {!!Form::label('name', 'User Name :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('email', 'User Email :', ['class' => 'input-group-text'])!!}
                {!!Form::text('email', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('role_id', 'User Role :', ['class' => 'input-group-text'])!!}
                {!!Form::select('role_id',$role,$user->role_id,['class' =>'form-control custom-select'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('photoo_id', 'User Image :', ['class' => 'input-group-text'])!!}
                {!!Form::file('photo_id')!!}
        </div>

        <div class="form-group">
                        {!!Form::label('password', 'User Password :', ['class' => 'input-group-text'])!!}
                        {!!Form::password('password',['class' => 'form-control'])!!}
                </div>

        <div class="form-group" >
                {!!Form::submit('Update',['class' =>'form-control btn btn-primary'])!!}
        </div>
</div>
 
{!! Form::close() !!}
<div class="col-md-4">

        <img class="img-circle" width="350" height="350" src="{{$user->photo ? $user->photo->file.$user->photo->path : 'img/avatar1.jpg'}}" alt="">
 
        </div>
</div>
    @include('includes.errors')
@endsection