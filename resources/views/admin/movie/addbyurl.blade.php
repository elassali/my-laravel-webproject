@extends('layouts.AdminMaster')
@section('content')
<div class="box">
    <div class="col-md-12 offset-md-4">
        @if( $success = session()->get('success'))
        <div class="alert alert-info alert-dismissible" style="margin-top:10px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $success }}
              </div> 
       @endif
    </div>
<div class="row" style="margin:1px">    
        
{!! Form::open(['method'=>'POST','action'=>'Movie_Controller@storebyurl']) !!}
<div class="col-lg-8">
            
    <div class="form-group">
        {!!Form::label('IMDB', 'IMDB ID :', ['class' => 'input-group-text'])!!}
        {!!Form::textarea('imdbids', null, ['class' => 'form-control',])!!}
    </div> 

    <div class="form-group">
        {!!Form::label('quality', 'Movie Quality:', ['class' => 'input-group-text'])!!}
        {!!Form::select('quality',[''=>'Choose Quality','WEB-DL'=>'WEB-DL','HDRIP'=>'HDRIP','HDCAM'=>'HDCAM','HDTV'=>'HDTV','BluRay'=>'BluRay'],'',['class'=>'form-control'])!!}
       </div> 
       <div class="form-group" >
        {!!Form::submit('Create',['class' =>'form-control btn btn-primary','id' =>'start'])!!}
</div>
</div>
{!! Form::close() !!}
</div>  
@endsection