@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">All products</a></li>
        </ol>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Color list</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="width80">#</th>
                                <th>color Name</th>
                                <th>color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($color_info as $key => $color)
                            <tr>
                                <td><strong>{{$key+1}}</strong></td>
                                <td>{{$color->color_name}}</td>
                                <td><a width="20px" height="20px" style="background-color: #{{$color->color_code}}; padding: 10px 30px"></a></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg  viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Size list</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="width80">#</th>
                                <th>Size Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($size_info as $key => $size)
                            <tr>
                                <td><strong>{{$key+1}}</strong></td>
                                <td>{{$size->size_name}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg  viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Colors</h3>
            </div>
            <div class="card-body">
                <form action="{{route('add.color')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="text" name="color_name" placeholder="Color name">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="color_code" placeholder="Color code">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Add Size</h3>
            </div>
            <div class="card-body">
                <form action="{{route('add.size')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="text" name="size_name" placeholder="Size name">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
    @if(session('color_success'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{ session('color_success') }}',
            showConfirmButton: false,
            timer: 1500
            });
        </script>
    @endif
    @if(session('size_success'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{ session('size_success') }}',
            showConfirmButton: false,
            timer: 1500
            });
        </script>
    @endif
@endsection