@extends('layouts.AdminMaster')

@section('content')

<div class="row" style="margin:1px">
                <div class="col-md-12 offset-md-4">
                                @if( $success = session()->get('success'))
                                <div class="alert alert-success alert-dismissible" style="margin-top:10px;">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $success }}
                                      </div> 
                               @endif
                            </div>
 {!! Form::open(['method'=>'POST','action'=>'Advirtisement@store','files' => true]) !!}
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
                {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
        </div>

    </div>
{!! Form::close() !!}
       
</div>
@include('includes.errors')
@endsection