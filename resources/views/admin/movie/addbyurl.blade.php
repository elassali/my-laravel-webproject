@extends($role)
@section('content')
<div class="box">
    <div class="col-md-12 offset-md-4">
        @if( $success = session()->get('success'))
        <div class="alert alert-success alert-dismissible" style="margin-top:10px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $success }}
              </div> 
       @endif
    </div>
    
    {!! Form::open(['method'=>'POST','action'=>'Movie_Controller@storebyurl','files' => true]) !!}      
     <ul class="nav nav-tabs">
       <li class="nav-item">
       <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Movie Details</a>
       </li>
       </ul>
       <div class="tab-content" style="margin-top:16px;">
           <!-- First -->
       <div class="tab-pane active" id="login_details">
       <div class="panel panel-default">
       <div class="panel-heading">Movie Details</div>
       <div class="panel-body">

           <div class="form-group">
            {!!Form::label('imdb', 'IMBD ID :', ['class' => 'input-group-text'])!!}
            {!!Form::text('imdb', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('trailer', 'Trailer URL :', ['class' => 'input-group-text'])!!}
            {!!Form::text('trailer', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('quality', 'Movie Quality:', ['class' => 'input-group-text'])!!}
            {!!Form::select('quality',[''=>'Choose Quality','WEB-DL'=>'WEB-DL','HDRIP'=>'HDRIP','HDCAM'=>'HDCAM','HDTV'=>'HDTV','BluRay'=>'BluRay'],'',['class'=>'form-control'])!!}
           </div> 

           <br />
       </div>
       </div>
       </div>
      
          {!!Form::submit('Create',['class'=>'btn btn-success btn-lg'])!!}
        </div>
           <br />
       </div>
       </div>
       </div>
       </div>
       {!! Form::close() !!}
       @include('includes.errors')

    </div>
@endsection
