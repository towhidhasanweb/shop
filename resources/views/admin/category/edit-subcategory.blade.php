@extends('layouts.dashboard')

@section ('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('subcategory')}}">Sub category</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">edit</a></li>
        </ol>
</div>
<div class="row">
<div class="col-lg-6 m-auto">
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header bg-primary">
                <h3 class="text-white">Edit Sub Category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update.subcategory')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select disabled name="category" class="form-control">
                            <option value="">-- select category --</option>
                            @foreach ($category_name as $category)
                                <option  value="{{$category->id}}" {{ ($category->id == $subcategory_info->category_id) ? 'selected' :''}} >{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        
                        <input type="hidden" value="{{$subcategory_info->id}}" name="subcategory_id">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Sub category Name</label>
                        <input type="text" class="form-control" value="{{$subcategory_info->subcategory_name}}" name="subcategory_name">
                        @error('subcategory_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection