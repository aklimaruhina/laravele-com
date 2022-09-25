@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
        
            <div class="card">

            <div class="card-body">
                <h4 class="card-title">
                    {{@$data ? 'Edit Category' : 'Create Category' }}
                </h4>
                @if(Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                @endif
               <!-- Both Create and edit data -->
               <!-- jodi data thake tahole Edit route e nibe na hole new create route e nibe -->
                <form class="forms-sample" method="POST" action="{{ @$data ? route('category.update', $data->id) :  route('category.store')}}">
                    <!-- Edit korar jonno method PUt e hoi ar create korar somoy sudhu post hoi -->
                    @if(@$data)
                        @csrf
                        @method('PUT') 
                    @else   
                    @csrf
                    @endif
                <div class="form-group">
                    <label for="exampleInputUsername1">Category Name</label>
                    <input type="text" class="form-control" id="category" placeholder="Category Name" name="cat_name" value="{{ @$data ? $data->cat_name : old('cat_name')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Slug</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category slug" name="cat_slug" value="{{ @$data ? $data->cat_slug : old('cat_slug')}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Parent Id</label>
                    <select name="parent_id" id="" class="form-control">
                    @php $selected = '';@endphp    
                    @if(@$data)
                        @php $selected = (($data->parent_id == 0 ) ? 'selected': ''); @endphp
                        @endif
                        
                        <option value="0" {{$selected}}>Parent</option>
                        @foreach($category as $cat)
                        @if(@$data)
                        @php $selected = ($data->parent_id == $cat->id) ? 'selected': ''; @endphp
                        @endif
                        <option value="{{$cat->id}}" {{$selected}}>{{$cat->cat_name}}</option>
                        @endforeach

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