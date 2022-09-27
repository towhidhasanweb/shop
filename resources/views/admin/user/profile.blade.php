@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Name</h3>
            </div>
            <div class="card-body">
                @if (session('name_update'))
                    <div class="alert alert-success">{{session('name_update')}}</div>
                @endif
                <form action="{{ route('name.change')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Name</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Password</h3>
            </div>
            <div class="card-body">
                @if (session('password_update'))
                    <div class="alert alert-success">{{session('password_update')}}</div>
                @endif
                
                <form action="{{ route('password.change')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Old Password</label>
                        <input class="form-control" type="password" name="old_password">
                        @error('old_password')
                            <b >{{ $message }}</b>
                        @enderror
                        @if (session('password_wrong'))
                    <div class="alert alert-success">{{session('password_wrong')}}</div>
                @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input class="form-control" type="password" name="password">
                        @error('password')
                            <b >{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation">
                        @error('password_confirmation')
                            <b >{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Profile Photo</h3>
            </div>
            <div class="card-body">
                @if (session('photo_update'))
                    <div class="alert alert-success">{{session('photo_update')}}</div>
                @endif
                <form action="{{ route('photo.change')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="file" name="profile_image" >
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Name</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection