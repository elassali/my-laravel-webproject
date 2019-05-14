@extends("layouts.AdminMaster")
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
        
{!! Form::open(['method'=>'POST','action'=>'Remot@store']) !!}
<div class="col-lg-6">
            
    <div class="form-group">
        {!!Form::label('IMDB', 'IMDB ID :', ['class' => 'input-group-text'])!!}
        {!!Form::textarea('imdbids', null, ['class' => 'form-control','style'=>'resize:none'])!!}
    </div> 
</div>
<div class="col-lg-6">
    <div class="form-group">
        {!!Form::label('url', 'Video Urls :', ['class' => 'input-group-text'])!!}
        {!!Form::textarea('urls', null, ['class' => 'form-control','style'=>'resize:none'])!!}
    </div> 
</div>
   
       <div class="form-group" >
        {!!Form::submit('Create',['class' =>'form-control btn btn-primary','id' =>'start'])!!}
      </div>
{!! Form::close() !!}
</div>  
@endsection