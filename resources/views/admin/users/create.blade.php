@extends('layouts.AdminMaster')

@section('content')

<div class="row" style="margin:1px">

 {!! Form::open(['method'=>'POST','action'=>'UserController@store','files' => true]) !!}
    <div class="col-lg-8">
                
        <div class="form-group">
            {!!Form::label('name', 'User Name :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('email', 'User Email :', ['class' => 'input-group-text'])!!}
                {!!Form::text('email', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('password', 'User Password :', ['class' => 'input-group-text'])!!}
                {!!Form::password('password',['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('role_id', 'User Role :', ['class' => 'input-group-text'])!!}
                {!!Form::select('role_id',[''=>'Choose Role']+$role,'',['class' =>'form-control custom-select'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('photo_id', 'User Image :', ['class' => 'input-group-text'])!!}
                {!!Form::file('photo_id',null)!!}
        </div>

        <div class="form-group" >
                {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
        </div>

    </div>
{!! Form::close() !!}
       
</div>
@include('includes.errors')
@endsection