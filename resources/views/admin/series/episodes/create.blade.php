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
    {!! Form::open(['method'=>'POST','action'=>'EpisodeController@store']) !!}
  <ul class="nav nav-tabs">
   <li class="nav-item">
    <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Watch Episodes</a>
   </li>

   <li class="nav-item">
    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Download Episodes</a>
   </li>
  </ul>
  <div class="tab-content" style="margin-top:16px;">
   <div class="tab-pane active" id="login_details">
    <div class="panel panel-default">
     <div class="panel-heading">Watch Episodes</div>
     <div class="panel-body">

        <div class="form-group">
            {!!Form::label('serie_id', 'Serie Name:', ['class' => 'input-group-text'])!!}
            {!!Form::select('serie_id',[''=>'Choose Serie']+$serie,'',['id'=>'serie','class'=>'form-control'])!!}
           </div>

           <div class="form-group">
              {!!Form::label('season_id', 'Season Number:', ['class' => 'input-group-text'])!!}
            <select class="form-control" name="season_id" id="season">
                <option value="">Choose Season</option>
            </select>
            </div>

            <div class="form-group">
                {!!Form::label('episode_number', 'Episode Number :', ['class' => 'input-group-text'])!!}
                {!!Form::text('episode_number', null, ['class' => 'form-control'])!!}
               </div>

        <div class="form-group">
            {!!Form::label('wserverone', 'Server One :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverone', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wservertwo', 'Server Two :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wservertwo', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wserverthree', 'Server Three :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverthree', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wserverfour', 'Server Four :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverfour', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('wserverfive', 'Server Five :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverfive', null, ['class' => 'form-control'])!!}
           </div>
           <div class="form-group">
            {!!Form::label('wserversix', 'Server Six :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserversix', null, ['class' => 'form-control'])!!}
           </div>
           <br />
           <div align="center">
           <button type="button" name="btn_personal_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button>
           </div>
      <br />
     </div>
    </div>
   </div>
   <div class="tab-pane fade" id="contact_details">
    <div class="panel panel-default">
     <div class="panel-heading">Download Episodes</div>
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

           <div class="form-group">
            {!!Form::label('dserverfour', 'Server Four :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverfour', null, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dserverfive', 'Server Five :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverfive', null, ['class' => 'form-control'])!!}
           </div>
           <div class="form-group">
            {!!Form::label('dserversix', 'Server Six :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserversix', null, ['class' => 'form-control'])!!}
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
</div>
@include('includes.errors')
@endsection
@section('footer')
<script src="{{asset('js/multi_f_episode.js')}}"></script>
<script>
    $(document).ready(function()
    {
      $(document).on('change','#serie',function(){

        var serie_id=$(this).val();
        var selection=$('#season');
        var op ="";

        $.ajax({
                  type:'get',
                  url:'{!!URL::to('findepisode')!!}',
                  data:{'id':serie_id},
                  success:function(data)
                  {
                    op='<option value="">Choose Season</option>';
                    for(var i=0;i<data.length;i++)
                    {
                      op+='<option value="'+data[i].id+'">'+data[i].season_number+'</option>';  
                    }
                    selection.html("");
                    selection.append(op);
                  },
                  error:function()
                  {

                  }
        });
      });






    });

</script>
@endsection