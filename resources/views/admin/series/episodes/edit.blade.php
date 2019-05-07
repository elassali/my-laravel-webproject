@extends($role)
@section('content')
<div class="box">
        {!! Form::model($watch,['method'=>'PATCH','route' => ['episode.update', $watch->id]]) !!}
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
            {!!Form::select('serie_id',[''=>'Choose Serie']+$serie,$watch->serie->id,['id'=>'serie','class'=>'form-control'])!!}
           </div>

           <div class="form-group">
              {!!Form::label('season_id', 'Season Number:', ['class' => 'input-group-text'])!!}
            <select class="form-control" name="season_id" id="season">
                <option value="">Choose Season</option>
                @foreach ($season as $item)
              
                    @if ($item->id === $watch->season_id)
                    <option value="{{$item->id}}" selected>{{$item->season_number}}</option>
                    @else
                    <option value="{{$item->id}}">{{$item->season_number}}</option>
                    @endif
                        
                @endforeach
            </select>
            </div>

            <div class="form-group">
                {!!Form::label('episode_number', 'Episode Number :', ['class' => 'input-group-text'])!!}
                {!!Form::text('episode_number', $watch->episode_number, ['class' => 'form-control'])!!}
               </div>

        <div class="form-group">
            {!!Form::label('wserverone', 'IMDB ID :', ['class' => 'input-group-text'])!!}
            {!!Form::text('wserverone', $watch->server1, ['class' => 'form-control'])!!}
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
            {!!Form::text('dserverone', $down->server1, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dservertwo', 'Server Two :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dservertwo', $down->server2, ['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('dserverthree', 'Server Three :', ['class' => 'input-group-text'])!!}
            {!!Form::text('dserverthree', $down->server3, ['class' => 'form-control'])!!}
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