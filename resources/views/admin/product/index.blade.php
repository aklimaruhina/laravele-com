@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Product List</h4>
                  
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Product Name
                          </th>
                          <th>
                            Image
                          </th>
                          <th>
                            Category Name
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 1; @endphp
                        @foreach($products as $product)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{ $product->product_name}}</td>
                          <td><img src="{{asset('storage/uploads/products/'.$product->product_img)}}" alt="" width="200px"></td>
                          <td>{{$product->category->cat_name}}</td>
                          <td><div class="d-flex"><a  href="{{route('product.edit', $product->id)}}" class="btn btn-success btn-sm mr-4">Edit</a> | 
                          <form action="{{route('product.destroy', $product->id)}}" method="post" class="ml-2">
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