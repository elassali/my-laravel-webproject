@extends('layouts.AdminMaster')

@section('content')

<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="fa fa-envelope "></i> Email</th>  
                <th> <i class="icon_profile"></i> Name</th> 
                <th> <i class="icon_tag"></i> Subject</th>                                 
                <th> <i class=" fa fa-calendar "></i> Recived At</th> 
                <th> <i class="icon_cogs"></i> Action</th>   
                <th> <i class=" icon_comment_alt "></i> Message</th>  
              </tr>
              @foreach ($messages as $message)
              <tr>
                 <td>{{$message->email}}</td>
                <td>{{$message->firstname.' '.$message->lastname}}</td>
                <td>{{$message->subject}}</td>
                <td>{{$message->created_at->diffForHumans()}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['ContactController@destroy',$message->id]] )!!}
                  <div class="btn-group">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="icon_close_alt2"></i></button>  
                  </div>
                  {!! Form::close() !!}
                </td>
                
                  <td>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#{{$message->id}}" aria-expanded="false" aria-controls="collapseExample">
                     Click To Read Message
                    </button>
                </td>
 
              
              </tr>
           
              @endforeach
  
            </tbody>
          </table>
         
        </section>
      </div>
    </div>
    @foreach ($messages as $message)
    <div class="collapse " id="{{$message->id}}">
        <div class="card card-body">
          <hr>
          <p class="text-success">Message From: <span class="text-primary">{{$message->firstname.' '.$message->lastname}}</span> </p>
          {{$message->message}}
      </div>
    </div>
    @endforeach
</div>
<div class="text-center">{{$messages->links()}}</div>

@endsection