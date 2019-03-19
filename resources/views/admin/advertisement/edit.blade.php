@extends('layouts.AdminMaster')

@section('content')

<div class="row" style="margin:1px">

    {!! Form::model($ad, ['method'=>'PATCH','route' => ['advirtisement.update', $ad->id],'files'=>true])!!}
    <div class="col-lg-8">
                
        <div class="form-group">
            {!!Form::label('name', 'AD Name :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('adurl', 'AD Link :', ['class' => 'input-group-text'])!!}
                {!!Form::text('adurl', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
                {!!Form::label('photo_id', 'User Image :', ['class' => 'input-group-text'])!!}
                {!!Form::file('photo_id',null)!!}
        </div>

        <div class="form-group" >
                {!!Form::submit('Update',['class' =>'form-control btn btn-primary'])!!}
        </div>

    </div>
{!! Form::close() !!}
       
</div>
@include('includes.errors')
@endsection