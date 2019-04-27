@extends('layouts.AdminMaster')

@section('content')
<div class="row" style="margin:1px">
    
    {!! Form::model($api, ['method'=>'PATCH','route' => ['apiaccount.update', $api->id]])!!}
       <div class="col-lg-12">
           <div class="form-group">
               {!!Form::label('login', 'Api Login :', ['class' => 'input-group-text'])!!}
               {!!Form::text('login', $api->apilogin, ['class' => 'form-control'])!!}
           </div> 
           <div class="form-group">
               {!!Form::label('key', 'Api Key :', ['class' => 'input-group-text'])!!}
               {!!Form::text('key', $api->apikey , ['class' => 'form-control'])!!}
           </div>
           <div class="form-group">
                {!!Form::label('host', 'Host Name:', ['class' => 'input-group-text'])!!}
                {!!Form::select('host',[''=>'Choose Host','openload'=>'openload','streamango'=>'streamango','vidcloud'=>'vidcloud'],$api->hostname,['class'=>'form-control'])!!}
               </div> 
   
           <div class="form-group" >
                   {!!Form::submit('Update',['class' =>'form-control btn btn-primary'])!!}
           </div>
       </div>
   {!! Form::close() !!}
   @include('includes.errors')
</div>

@endsection