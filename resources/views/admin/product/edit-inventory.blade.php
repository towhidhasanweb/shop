@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Inventory</a></li>
        </ol>
</div>

<div class="row">
    <div class="col-lg-8"></div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add inventory</h3>
            </div>
            <div class="card-body">
                <form action="{{route('edit.inventory.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="inventory_id" id="" value="{{$inventory_info->id}}">
                        <input type="text" class="form-control" readonly name="product_name" id="" value="{{$inventory_info->rel_to_product->product_name}}">
                    </div>
                    <div class="mb-3">
                        <select name="color_name" id="" class="form-control">
                            <option value="">-- Select Color --</option>
                            @foreach ($color_info as $color)
                                <option value="{{$color->id}}" {{ ($color->id == $inventory_info->color_id) ? 'selected' :''}} >{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="size_name" id="" class="form-control">
                            <option value="">-- Select size --</option>
                            @foreach($size_info as $key => $sizes)
                                <option value="{{$sizes->id}}" {{ ($sizes->id == $inventory_info->size_id) ? 'selected' :''}} >{{$sizes->size_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        
                        <input type="text" class="form-control"  name="quantity" id="" value="{{$inventory_info->quantity}}" placeholder="Quantity">
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