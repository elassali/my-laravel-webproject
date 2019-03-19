@extends($role)


@section('content')
<div class="box">
    {!! Form::model($movie, ['method'=>'PATCH','route' => ['movie.update', $movie->id],'files'=>true])!!}
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
            {!!Form::label('photo_id', 'Movie Image :', ['class' => 'input-group-text'])!!}
            {!!Form::file('photo_id',null)!!}
           </div>

           <div class="form-group">
            {!!Form::label('country', 'Movie Country:', ['class' => 'input-group-text'])!!}
            {!!Form::select('country',[''=>'Choose Country']+$country,$movie->country_id,['class'=>'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('category', 'Movie Category :', ['class' => 'input-group-text'])!!}
            <br>
            {!!Form::select('category[]',$category,'',['id'=>'category','class'=>'form-control','multiple' => true])!!}
           </div>
           <div class="form-group">
            {!!Form::label('quality', 'Movie Quality:', ['class' => 'input-group-text'])!!}
            {!!Form::select('quality',[''=>'Choose Quality','WEB-DL'=>'WEB-DL','HDRIP'=>'HDRIP','HDCAM'=>'HDCAM','HDTV'=>'HDTV','BluRay'=>'BluRay'],'',['class'=>'form-control'])!!}
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
            {!!Form::label('wserverone', 'Server One :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverone', $movie->watch->server1, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wservertwo', 'Server Two :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wservertwo', $movie->watch->server2, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wserverthree', 'Server Three :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverthree', $movie->watch->server3, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wserverfour', 'Server Four :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverfour', $movie->watch->server4, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wserverfive', 'Server Five :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverfive', $movie->watch->server5, ['class' => 'form-control'])!!}
           </div>
           <div class="form-group">
            {!!Form::label('wserversix', 'Server Six :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserversix', $movie->watch->server6, ['class' => 'form-control'])!!}
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
            {!!Form::text('dserverone', $movie->download->server1, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dservertwo', 'Server Two :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dservertwo', $movie->download->server2, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dserverthree', 'Server Three :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverthree', $movie->download->server3, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dserverfour', 'Server Four :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverfour', $movie->download->server4, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dserverfive', 'Server Five :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverfive', $movie->download->server5, ['class' => 'form-control'])!!}
           </div>
           <div class="form-group">
            {!!Form::label('dserversix', 'Server Six :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserversix', $movie->download->server6, ['class' => 'form-control'])!!}
           </div>
           <br />
           <div align="center">
           <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
           {{-- <button type="submit" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Register</button> --}}
          {!!Form::submit('Update',['class'=>'btn btn-success btn-lg'])!!}
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