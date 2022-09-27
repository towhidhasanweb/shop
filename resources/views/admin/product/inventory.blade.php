@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Inventory</a></li>
        </ol>
</div>

<div class="row">
    <div class="col-lg-8">
    <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$product_info->product_name}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="width80">#</th>
                                <th>Product Name</th>
                                <th>color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventory_info as $key => $invertory)
                            <tr>
                                <td><strong>{{$key+1}}</strong></td>
                                
                                <td>{{$invertory->rel_to_product->product_name}}</td>
                                <td><a width="20px" height="20px" style="background-color: #{{$invertory->rel_to_color->color_code}}; padding: 10px 30px"></a></td>
                                <td>{{$invertory->rel_to_size->size_name}}</td>
                                <td>{{$invertory->quantity}}</td>
                                
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('edit.inventory', $invertory->id)}}">Edit</a>
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
                <h3>Add inventory</h3>
            </div>
            <div class="card-body">
                <form action="{{route('inventory.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="product_id" id="" value="{{$product_info->id}}">
                        <input type="text" class="form-control" readonly name="product_name" id="" value="{{$product_info->product_name}}">
                    </div>
                    <div class="mb-3">
                        <select name="color_name" id="" class="form-control">
                            <option value="">-- Select Color --</option>
                            @foreach ($color_info as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="size_name" id="" class="form-control">
                            <option value="">-- Select size --</option>
                            @foreach($size_info as $key => $sizes)
                                <option value="{{$sizes->id}}">{{$sizes->size_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        
                        <input type="text" class="form-control"  name="quantity" id="" value="" placeholder="Quantity">
                    </div>
                    <div class="mb-3">
                        
                        <button type="submit" class="btn btn-primary">Add inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
@if(session('inventory_added'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{ session('inventory_added')}}',
        showConfirmButton: false,
        timer: 1500
        });
    </script>
@endif
@endsection