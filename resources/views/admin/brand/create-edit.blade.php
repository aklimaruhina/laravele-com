@extends('admin.layout.app')
@section('custom_css')
<style>
    img{
        max-width: 100%;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
        
            <div class="card">

            <div class="card-body">
                <h4 class="card-title">
                    {{@$data ? 'Edit Brand' : 'Create Brand' }}
                </h4>
               <!-- Display error message -->
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               <!-- Both Create and edit data -->
               <!-- jodi data thake tahole Edit route e nibe na hole new create route e nibe -->
                <form class="forms-sample" method="POST" action="{{ @$data ? route('brand.update', $data->id) :  route('brand.store')}}" enctype="multipart/form-data">
                    <!-- Edit korar jonno method PUt e hoi ar create korar somoy sudhu post hoi -->
                    @if(@$data)
                        @csrf
                        @method('PUT') 
                    @else   
                    @csrf
                    @endif
                <div class="form-group">
                    <label for="exampleInputUsername1">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" placeholder="Brand Name" name="brand_name" value="{{ @$data ? $data->brand_name : old('brand_name')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand Slug</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Brand slug" name="brand_slug" value="{{ @$data ? $data->brand_slug : old('brand_slug')}}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Upload Image</label>
                            <input type="file" name="image" onchange="previewFile(this);" />
                        </div>
                    </div>
                    <div class="col-md-6">
                    <img id="previewImg" src="{{asset('default.jpg')}}" alt="Placeholder" class="img-responsive">
                    </div>
                    <div class="col-md-6">
                        @if(@$data)
                        <img src="{{asset('storage/uploads/brands/'.$data->image)}}" alt="" style="width:150px; height: 100px">
                        @endif
                    </div>
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