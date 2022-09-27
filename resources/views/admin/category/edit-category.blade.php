@extends('layouts.dashboard')

@section ('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('category')}}">category</a></li>
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
                <h3 class="text-white">Add Category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update.category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="hidden" value="{{$category_info->id}}" name="category_id">
                        <input type="text" class="form-control" value="{{$category_info->category_name}}" name="category_name">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" class="form-control" name="category_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img id="blah" src="{{asset('upload/category')}}/{{$category_info->category_image}}" alt="your image" width="150" />
                        @error('category_image')
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