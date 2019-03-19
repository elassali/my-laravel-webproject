@extends($role)
@section('content')
<div class="row" style="margin:1px">

    {!! Form::model($serie,['method'=>'PATCH','route' => ['serie.update', $serie->id],'files' => true]) !!}
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
            {!!Form::select('country',[''=>'Choose Country']+$country,$serie->country_id,['class'=>'form-control'])!!}
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
   
           <div class="form-group" >
                   {!!Form::submit('Update',['class' =>'form-control btn btn-primary'])!!}
           </div>
   
       </div>
   {!! Form::close() !!}
          
   </div>
   @include('includes.errors')

@endsection

@section('footer')
<script src="{{asset('js/select_plugin.js')}}"></script>
@endsection
