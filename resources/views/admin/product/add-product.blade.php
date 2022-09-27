@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add product</a></li>
        </ol>
</div>
<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Add Product</h3>
            </div>
            <div class="card-body">
                <form action="{{route('product.upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <select name="category_id" id="category_id" class="form-control" >
                                    <option value="">-- select category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <select name="subcategory_id" id="subcategory_id" class="form-control" id="">
                                    <option value="">-- select Sub category --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="product_name" placeholder="Product name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="product_brand" placeholder="Product Brand">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="product_price" placeholder="Product price">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="discount_price" placeholder="Discount price">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="short_desc" placeholder="Short description">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <textarea class="form-control" id="summernote" name="long_desc" placeholder="Long description" > </textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Thumbnails</label>
                                <input type="file" name="preview" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Product images</label>
                                <input type="file" multiple name="product_gallery[]" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 mt-2 text-center">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script>
    $('#category_id').change(function(){
        let category_id = $(this).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getsubcategory',
            data:{'category_id':category_id},
            success:function(data){
                $('#subcategory_id').html(data);
            }
        });
    });
</script>
@if(session('success'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1500
        });
    </script>
@endif
@endsection