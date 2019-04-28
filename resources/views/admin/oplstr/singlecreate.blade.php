@extends('layouts.AdminMaster')
@section('content')

<div class="row" style="margin:1px">    
        
{!! Form::open(['method'=>'POST','action'=>'Remot@store']) !!}
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
        {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
</div>
</div>
{!! Form::close() !!}
   
</div>  
@endsection
