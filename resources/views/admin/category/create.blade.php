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
 {!! Form::open(['method'=>'POST','action'=>'CategoryController@store']) !!}
    <div class="col-lg-8">
                
        <div class="form-group">
            {!!Form::label('name', 'Category Name :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
        </div> 

        <div class="form-group" >
                {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
        </div>

    </div>
{!! Form::close() !!}
       
</div>
@endsection