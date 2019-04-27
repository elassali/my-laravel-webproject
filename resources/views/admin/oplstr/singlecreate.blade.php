@extends('layouts.AdminMaster')
@section('content')

{{-- <div class="row" style="margin:1px">    
        
{!! Form::open(['method'=>'POST','action'=>'Remot@store']) !!}
<div class="col-lg-8">
            
    <div class="form-group">
        {!!Form::label('URL', 'URL :', ['class' => 'input-group-text'])!!}
        {!!Form::url('name', null, ['class' => 'form-control'])!!}
    </div> 
    <div class="form-group">
        {!!Form::label('IMDB', 'IMDB ID :', ['class' => 'input-group-text'])!!}
        {!!Form::text('ID', null, ['class' => 'form-control'])!!}
    </div> 

    <div class="form-group" >
            {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
    </div>

</div>
{!! Form::close() !!}
   
</div> --}}
<?php
        $url="http://www.omdbapi.com/?i=tt4154796&apikey=1c2aadc3";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($data,true);
     echo   var_dump($result);

?>
    
@endsection