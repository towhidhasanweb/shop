@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">category</a></li>
        </ol>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            @if(session('delete'))
                <div class="alert alert-success">{{session('delete')}}</div>
            @endif
            @if(session('restore'))
                <div class="alert alert-success">{{session('restore')}}</div>
            @endif
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>category Image</th>
                        <th>added by</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($all_categorys as $key=>$category)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$category->category_name}}</td>
                        <td><img width="50" src="{{asset('upload/category')}}/{{$category->category_image}}" alt=""></td>
                        <td>{{$category->rel_to_user->name}}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{route('edit.category', $category->id)}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('delete.category',$category->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
							</div></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card">
            @if(session('hard_delete'))
                <div class="alert alert-success">{{session('hard_delete')}}</div>
            @endif
            
            <div class="card-header">
                <h3>Trashed Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>category Image</th>
                        <th>added by</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($trash_category as $key=>$category)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$category->category_name}}</td>
                        <td><img width="50" src="{{asset('upload/category')}}/{{$category->category_image}}" alt=""></td>
                        <td>{{$category->rel_to_user->name}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('restore.category',$category->id)}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-undo"></i></a>
                                <a href="{{route('harddelete.category',$category->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
							</div></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header bg-primary">
                <h3 class="text-white">Add Category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" class="form-control" name="category_image">
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