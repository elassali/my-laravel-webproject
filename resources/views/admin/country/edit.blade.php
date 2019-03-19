@extends('layouts.AdminMaster')

@section('content')
{!! Form::model($country, ['method'=>'PATCH','route' => ['country.update', $country->id]])!!}
    

        <div class="form-group">
            {!!Form::label('name', 'Country Name :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group" >
                {!!Form::submit('Update',['class' =>'form-control btn btn-primary'])!!}
        </div>
</div>
 
{!! Form::close() !!}
@endsection