@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub-category</a></li>
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
            <div class="card-header bg-primary">
                <h3 class="text-white">Sub Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Sub Category Name</th>
                        <th>category name</th>
                        <th>Action</th>
                    </tr>
                    @foreach($subcategory_info as $key=>$subcategory)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td>{{$subcategory->rel_to_category->category_name}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('edit.subcategory', $subcategory->id)}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('delete.subcategory', $subcategory->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
							</div>
                        </td>
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
                <h3>Trashed Sub Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>category Image</th>
                        
                        <th>Action</th>
                    </tr>
                    @foreach ($trash_subcategory as $key=>$subcategory)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td>{{$subcategory->rel_to_category->category_name}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('restore.subcategory',$subcategory->id)}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-undo"></i></a>
                                <a href="{{route('harddelete.subcategory',$subcategory->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
                <h3 class="text-white">Add Sub Category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('add.subcategory')}}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category" class="form-control">
                            <option value="">-- select category --</option>
                            @foreach ($category_name as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">sub Category Name</label>
                        <input type="text" class="form-control" name="subcategory_name">
                        @error('subcategory_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if(session('exist'))
                            <strong class="text-danger">{{session('exist')}}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add sub Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection