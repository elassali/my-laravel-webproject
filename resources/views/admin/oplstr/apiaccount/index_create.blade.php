@extends('layouts.AdminMaster')

@section('content')

<div class="row" style="margin:1px">

 {!! Form::open(['method'=>'POST','action'=>'api_controller@store']) !!}
    <div class="col-lg-4">
        <div class="form-group">
            {!!Form::label('login', 'Api Login :', ['class' => 'input-group-text'])!!}
            {!!Form::text('login', null, ['class' => 'form-control'])!!}
        </div> 
        <div class="form-group">
            {!!Form::label('key', 'Api Key :', ['class' => 'input-group-text'])!!}
            {!!Form::text('key', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('host', 'Host Name:', ['class' => 'input-group-text'])!!}
            {!!Form::select('host',[''=>'Choose Host','openload'=>'openload','streamango'=>'streamango','vidcloud'=>'vidcloud'],'',['class'=>'form-control'])!!}
           </div> 

        <div class="form-group" >
                {!!Form::submit('Create',['class' =>'form-control btn btn-primary'])!!}
        </div>
        @include('includes.errors')
    </div>
{!! Form::close() !!}
    <div class="col-lg-8">
        <div class="col-lg-12">
            <section class="panel">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                      <th> <i class="icon_clipboard"></i> Api ID</th> 
                      <th> <i class="icon_lock"></i> Api Login</th> 
                      <th> <i class="icon_key"></i> Api Key</th> 
                    <th> <i class="icon_cloud"></i> Api Host</th>         
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  @foreach ($api as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->apilogin}}</td>
                    <td>{{$item->apikey}}</td>
                    <td>{{$item->hostname}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['api_controller@destroy',$item->id]] )!!}
                      <div class="btn-group">
                      <a class="btn btn-primary" href="{{route('apiaccount.edit',$item->id)}}"><i class="icon_pencil-edit"></i></a>                 
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="icon_close_alt2"></i></button>  
                      </div>
                      {!! Form::close() !!}
                    </td>
                  </tr>
                  @endforeach
      
                </tbody>
              </table>
            </section>
          </div>
        </div>
        
    </div>
@endsection