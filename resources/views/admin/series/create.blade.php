@extends($role)
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
    {!! Form::open(['method'=>'POST','action'=>'SerieController@store','files' => true]) !!}
       <div class="col-lg-8">
                   
           <div class="form-group">
               {!!Form::label('name', 'Serie Name :', ['class' => 'input-group-text'])!!}
               {!!Form::text('name', null, ['class' => 'form-control'])!!}
           </div>
   
           <div class="form-group">
                   {!!Form::label('year', 'Serie Year :', ['class' => 'input-group-text'])!!}
                   {!!Form::text('year', null, ['class' => 'form-control'])!!}
           </div>
   
           <div class="form-group">
                   {!!Form::label('rate', 'IMBD Rate :', ['class' => 'input-group-text'])!!}
                   {!!Form::text('rate',null,['class' => 'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('country', 'Serie Country:', ['class' => 'input-group-text'])!!}
            {!!Form::select('country',[''=>'Choose Country']+$country,'',['class'=>'form-control'])!!}
           </div>

           <div class="form-group">
            {!!Form::label('category', 'Serie Category :', ['class' => 'input-group-text'])!!}
            <br>
            {!!Form::select('category[]',$category,'',['id'=>'category','class'=>'form-control','multiple' => true])!!}
           </div>
    
   
           <div class="form-group">
                   {!!Form::label('photo_id', 'Serie Image :', ['class' => 'input-group-text'])!!}
                   {!!Form::file('photo_id',null)!!}
           </div>
           <div class="form-group">
                {!!Form::label('story', 'Serie Story :', ['class' => 'input-group-text'])!!}
                {!!Form::textarea('story', null, ['class' => 'form-control','style'=>'resize:none'])!!}
               </div>
   
           <div class="form-group" >
                   {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
           </div>
   
       </div>
   {!! Form::close() !!}
          
   </div>
   @include('includes.errors')

@endsection

@section('footer')
<script src="{{asset('js/select_plugin.js')}}"></script>
@endsection
