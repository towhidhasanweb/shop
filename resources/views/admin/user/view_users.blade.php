@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Total users') }} {{$total_users}}</div>
                @if (session('delete'))
                <div class="alert alert-success"> {{session('delete')}} </div>
                @endif

                <div class="card-body">
                   <table class="table table-striped"> 
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($view_users as $key=>$user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if($user->profile_image == null)
										<img width="50" src="{{ Avatar::create($user->name)->toBase64() }}" />
									@else
										<img src="{{ asset('upload/user')}}/{{ $user->profile_image}}" width="50" alt=""/>

									@endif</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('del.user', $user->id)}} " class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
								</div>
                            </td>
                        </tr>
                        @endforeach

                   </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection