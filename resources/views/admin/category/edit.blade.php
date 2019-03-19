@extends('layouts.AdminMaster')

@section('content')
{!! Form::model($category, ['method'=>'PATCH','route' => ['category.update', $category->id]])!!}
    

        <div class="form-group">
            {!!Form::label('name', 'User Name :', ['class' => 'input-group-text'])!!}
            {!!Form::text('name', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group" >
                {!!Form::submit('Update',['class' =>'form-control btn btn-primary'])!!}
        </div>
</div>
 
{!! Form::close() !!}
@endsection