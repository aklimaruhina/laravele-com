@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Category List</h4>
                  
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Category Name
                          </th>
                          <th>
                            Slug
                          </th>
                          <th>
                            Parent Id
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 1; @endphp
                        @foreach($category as $cat)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{$cat->cat_name}}</td>
                          <td>{{$cat->cat_slug}}</td>
                          <td>
                            @if($cat->parent_id == 0)
                            <p>Parent</p>
                            @else
                            {{$cat->parent->cat_name}}
                            @endif

                          </td>
                          <td><div class="d-flex"><a  href="{{route('category.edit', $cat->id)}}" class="btn btn-success btn-sm mr-4">Edit</a> | 
                          <!-- <a class="btn btn-danger" href="{{route('category.destroy', $cat->id)}}">Delete</a> -->
                          <form action="{{route('category.destroy', $cat->id)}}" method="post" class="ml-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                          </form></div>
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>
@endsection