@extends('layouts.AdminMaster')

@section('content')
    

<div class="rows">
    <div class="col-lg-12">
        <section class="panel">
          <table class="table table-striped table-advance table-hover">
            <tbody>
              <tr>
                <th> <i class="icon_grid-3x3 "></i> Category</th>         
                <th><i class="icon_cogs"></i> Action</th>
              </tr>
              @foreach ($category as $category)
              <tr>
                <td>{{$category->name}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['CategoryController@destroy',$category->id]] )!!}
                  <div class="btn-group">
                  <a class="btn btn-primary" href="{{route('category.edit',$category->id)}}"><i class="icon_pencil-edit"></i></a>                 
                    {{-- <a class="btn btn-danger" href="{{route('user.destroy',$user->id)}}"  ><i class="icon_close_alt2"></i></a> --}}
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