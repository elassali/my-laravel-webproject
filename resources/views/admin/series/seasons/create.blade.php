@extends($role)
@section('content')
<div class="col-md-12 offset-md-4">
                @if( $success = session()->get('success'))
                <div class="alert alert-success alert-dismissible" style="margin-top:10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $success }}
                      </div> 
               @endif
            </div>
<div class="row" style="margin:1px">

 {!! Form::open(['method'=>'POST','action'=>'SeasonController@store','files' => true]) !!}
    <div class="col-lg-8">
            <div class="form-group">
                    {!!Form::label('serie_id', 'Serie Name :', ['class' => 'input-group-text'])!!}
                    {!!Form::select('serie_id',[''=>'Choose Role']+$serie,'',['class' =>'form-control custom-select'])!!}
            </div>
                
            <div class="form-group">
                    {!!Form::label('season_num', 'Season Number :', ['class' => 'input-group-text'])!!}
                    {!!Form::select('season_num',[''=>'Choose Season','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20'],'',['class' =>'form-control custom-select'])!!}
            </div>

        <div class="form-group">
                {!!Form::label('trailer', 'Season trailer :', ['class' => 'input-group-text'])!!}
                {!!Form::text('trailer', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group" >
                {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
        </div>

    </div>
{!! Form::close() !!}
       
</div>
@include('includes.errors')
@endsection