@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
        
            <div class="card">

            <div class="card-body">
                <h4 class="card-title">
                    {{@$data ? 'Edit Product' : 'Create Product' }}
                </h4>
                @if(Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                @endif
               <!-- Both Create and edit data -->
               <!-- jodi data thake tahole Edit route e nibe na hole new create route e nibe -->
                <form class="forms-sample" method="POST" action="{{ @$data ? route('product.update', $data->id) :  route('product.store')}}" enctype="multipart/form-data">
                    <!-- Edit korar jonno method PUt e hoi ar create korar somoy sudhu post hoi -->
                    @if(@$data)
                        @csrf
                        @method('PUT') 
                    @else   
                    @csrf
                    @endif
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Product Name Name" name="product_name" value="{{ @$data ? $data->product_name : old('product_name')}}">
                </div>
                <div class="form-group">
                    <label for="">Product Slug</label>
                    <input type="text" class="form-control" id="slug" placeholder="Product slug" name="slug" value="{{ @$data ? $data->slug : old('slug')}}">
                </div>

                <div class="form-group">
                    <label for="">Category Id</label>
                    <select name="category_id" id="" class="form-control">
                    @php $selected = '';@endphp    
                    @if(@$data)
                        @php $selected = (($data->category_id == 0 ) ? 'selected': ''); @endphp
                        @endif
                        
                        <option value="0" {{$selected}}>Select Category</option>
                        @foreach($category as $cat)
                        @if(@$data)
                        @php $selected = ($data->category_id == $cat->id) ? 'selected': ''; @endphp
                        @endif
                        <option value="{{$cat->id}}" {{$selected}}>{{$cat->cat_name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Products Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                    @php $selected = '';@endphp    
                    @if(@$data)
                        @php $selected = (($data->brand_id == 0 ) ? 'selected': ''); @endphp
                        @endif
                        
                        <option value="0" {{$selected}}>Select Brand</option>
                        @foreach($brands as $brand)
                        @if(@$data)
                        @php $selected = ($data->brand_id == $brand->id) ? 'selected': ''; @endphp
                        @endif
                        <option value="{{$brand->id}}" {{$selected}}>{{$brand->brand_name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Short Description</label>
                    <textarea name="short_description"  class="form-control" id="" cols="30" rows="10">{{@$data->short_description ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Long Description</label>
                    <textarea name="long_description"  class="form-control summernote" id="summernote" cols="30" rows="10">{{@$data->long_description ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Product Code</label>
                    <input type="text" class="form-control" name="product_code" value="{{@$data->product_code ?? old('product_code')}}">
                </div>
                <div class="form-group">
                    <label for="">Product Purchase Price</label>
                    <input type="text" class="form-control" name="purchase_price" value="{{@$data->purchase_price ?? old('purchase_price')}}">
                </div>
                <div class="form-group">
                    <label for="">Product Sale Price</label>
                    <input type="text" class="form-control" name="sales_price" value="{{@$data->sales_price ?? old('sales_price')}}">
                </div>
                <div class="form-group">
                    <label for="">Unit Amount</label>
                    <input type="text" class="form-control"  name="unit_amount" value="{{@$data->unit_amount ?? old('unit_amount')}}">
                </div>
                <div class="form-group">
                    <label for="">Unit Type</label>
                    <select name="unit_type" id="" class="form-control">
                        <option value="pcs">Pcs</option>
                        <option value="boxes">Boxs</option>
                        <option value="slices">Slices</option>
                        <option value="gram">Gram</option>
                        <option value="kg">Kg</option>
                        <option value="ml">ML</option>
                        <option value="litre">Litre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Total Stock</label>
                    <input type="text" class="form-control" name="total_stock" value="{{@$data->total_stock ?? old('total_stock')}}">
                </div>
                <div class="form-group">
                    <label for="">Product color</label>
                    <input type="text" class="form-control" name="color" value="{{@$data->color ?? old('color')}}">
                </div>
                <div class="form-group">
                    <label for="">Product Min Order</label>
                    <input type="text" class="form-control" name="min_order" value="{{@$data->min_order ?? old('min_order')}}">
                </div>
               
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="form-control" name="product_img" onchange="previewFile(this);">
                    
                        </div>
                    </div>
                    <div class="col-md-6"><img id="previewImg" src="{{asset('default.jpg')}}" alt="Placeholder" class="img-responsive" style="max-width:100%"></div>
                </div>
                <div class="form-group">
                    <label for="">Is Featured</label>
                    <select name="featured" id="" class="form-control">
                        <option value="0" {{((@$data->featured == 0 ) ? 'selected': '')}}>No</option>
                        <option value="1"  {{((@$data->featured == 1 ) ? 'selected': '')}}>Yes</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
    function previewFile(input){
      
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
  </script>
@endsection