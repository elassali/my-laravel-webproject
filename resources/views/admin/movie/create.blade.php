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
    
    {!! Form::open(['method'=>'POST','action'=>'Movie_Controller@store','files' => true]) !!}      
     <ul class="nav nav-tabs">
       <li class="nav-item">
       <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Movie Details</a>
       </li>
       <li class="nav-item">
       <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Watching Server Details</a>
       </li>
       <li class="nav-item">
       <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Download Server Details</a>
       </li>
       </ul>
       <div class="tab-content" style="margin-top:16px;">
           <!-- First -->
       <div class="tab-pane active" id="login_details">
       <div class="panel panel-default">
       <div class="panel-heading">Movie Details</div>
       <div class="panel-body">
           <div class="form-group">
            {!!Form::label('name', 'Movie Title :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('year', 'Production Year :', ['class' => 'input-group-text'])!!}
            {!!Form::text('year', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('rate', 'IMBD Rate :', ['class' => 'input-group-text'])!!}
            {!!Form::text('rate', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('trailer', 'Trailer URL :', ['class' => 'input-group-text'])!!}
            {!!Form::text('trailer', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('photo_idcr', 'Movie Image for carousel :', ['class' => 'input-group-text'])!!}
            {!!Form::file('photo_idcr',null)!!}
           </div>

           <div class="form-group">
            {!!Form::label('photo_id', 'Movie Image :', ['class' => 'input-group-text'])!!}
            {!!Form::file('photo_id',null)!!}
           </div>         

           <div class="form-group">
            {!!Form::label('country', 'Movie Country:', ['class' => 'input-group-text'])!!}
            {!!Form::select('country',[''=>'Choose Country']+$country,'',['class'=>'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('quality', 'Movie Quality:', ['class' => 'input-group-text'])!!}
            {!!Form::select('quality',[''=>'Choose Quality','WEB-DL'=>'WEB-DL','HDRIP'=>'HDRIP','HDCAM'=>'HDCAM','HDTV'=>'HDTV','BluRay'=>'BluRay'],'',['class'=>'form-control'])!!}
           </div> 

           <div class="form-group">
            {!!Form::label('category', 'Movie Category :', ['class' => 'input-group-text'])!!}
            <br>
            {!!Form::select('category[]',$category,'',['id'=>'category','class'=>'form-control','multiple' => true])!!}
           </div>

           <div class="form-group">
            {!!Form::label('story', 'Movie Story :', ['class' => 'input-group-text'])!!}
            {!!Form::textarea('story', null, ['class' => 'form-control','style'=>'resize:none'])!!}
           </div>
           <br />
           <div align="center">
           <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button>
           </div>
           <br />
       </div>
       </div>
       </div>
       <!-- Seconde -->
       <div class="tab-pane fade" id="personal_details">
       <div class="panel panel-default">
       <div class="panel-heading">Watching Server Details</div>
       <div class="panel-body">
        <div class="form-group">
            {!!Form::label('wserverone', 'IMDB ID :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverone', null, ['class' => 'form-control'])!!}
           </div>

          
           <br />
           <div align="center">
           <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
           <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info btn-lg">Next</button>
           </div>
           <br />
       </div>
       </div>
       </div>
       <!-- third -->
       <div class="tab-pane fade" id="contact_details">
       <div class="panel panel-default">
       <div class="panel-heading">Download Server Details</div>
       <div class="panel-body">
        <div class="form-group">
            {!!Form::label('dserverone', 'Server One :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverone', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dservertwo', 'Server Two :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dservertwo', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dserverthree', 'Server Three :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverthree', null, ['class' => 'form-control'])!!}
           </div>
           <br />
           <div align="center">
           <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
           {{-- <button type="submit" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Register</button> --}}
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
@section('footer')
<script src="{{asset('js/multi_f_movie.js')}}"></script>
<script src="{{asset('js/select_plugin.js')}}"></script>
@endsection