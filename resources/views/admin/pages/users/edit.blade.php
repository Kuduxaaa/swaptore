@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                    </div>
                @endif

                @if(session('message'))
                    <div class="alert alert-success mt-4">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="header-title">User edit/add</h4>
                            <p class="sub-header">From here you can modify user information or create new user</p>

                            <form action="" method="post" class="mt-4">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" name="first_name" class="form-control"
                                                    placeholder="First name" value="@if(isset($user)){{$user->first_name}}@endif">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" name="last_name" class="form-control"
                                                    placeholder="Last name" value="@if(isset($user)){{$user->last_name}}@endif">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Email" value="@if(isset($user)){{$user->email}}@endif">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="tel" class="form-control" placeholder="Phone number" 
                                                    name="phone_number" value="@if(isset($user)){{$user->phone_number}}@endif">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select name="role" class="form-control">
                                                    <option> Select user role </option>
                                                    <option value="1" @if (isset($user) && $user->role == 1) selected @endif>Member</option>
                                                    <option value="2" @if (isset($user) && $user->role == 2) selected @endif>Administrator</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Country" name="country" value="@if(isset($user) && $user->addresses){{$user->addresses->country}}@endif">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="city" class="form-control" placeholder="City" value="@if(isset($user) && $user->addresses){{$user->addresses->city}}@endif">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address line #1" name="primary_address" value="@if(isset($user) && $user->addresses){{$user->addresses->primary_address}}@endif">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address line #2" name="secondary_address" value="@if(isset($user) && $user->addresses){{$user->addresses->secondary_address}}@endif">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Zip/Postal Code" name="zip_code" value="@if(isset($user) && $user->addresses){{$user->addresses->zip_code}}@endif">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="New password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-md w-100 mt-4 mb-2">Submit</button>

                                    @if (isset($user))
                                        <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="w-100">
                                            <button type="button" class="btn btn-danger btn-md w-100">Remove</button>
                                        </a>
                                    @endif
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection