@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Brand List</h4>
                  <!-- Print success message -->
                  @if(Session::has('success'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                @endif
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Brand Name
                          </th>
                          <th>
                            Slug
                          </th>
                          <th>
                            Image
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 1; @endphp
                        @foreach($brands as $brand)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{$brand->brand_name}}</td>
                          <td>{{$brand->brand_slug}}</td>
                          <td>
                           <img src="{{asset('storage/uploads/brands')}}/{{$brand->image}}">
                          </td>
                          <td><div class="d-flex"><a  href="{{route('brand.edit', $brand->id)}}" class="btn btn-success btn-sm mr-4">Edit</a> | 
                          <form action="{{route('brand.destroy', $brand->id)}}" method="post" class="ml-2">
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