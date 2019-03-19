@extends('layouts.AdminMaster')

@section('content')
    

<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_datareport_alt"></i> Id</th>     
                <th> <i class="fa fa-envelope "></i> Email</th>  
                <th> <i class=" fa fa-calendar "></i> Created At</th>                        
              </tr>
              @foreach ($emails as $email)
              <tr>
                <td>{{$email->id}}</td>
                <td>{{$email->email}}</td>
                <td>{{$email->created_at->diffForHumans()}}</td>
              </tr>
              @endforeach
  
            </tbody>
          </table>
        </section>
      </div>
    </div>
</div>
<div class="blog-pagenat-wthree text-center">    
  {{$emails->links()}}
</div>
@endsection