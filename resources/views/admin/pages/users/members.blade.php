@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <a href="{{ route('admin.user.add') }}">
                                        <button class="btn btn-success">New user</button>
                                    </a>
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>

                {{ $members->links('pagination::bootstrap-4') }}

                <div class="row">
                    <div class="col-12 mt-4">
                        
                        @if(session('message'))
                            <div class="alert alert-success mt-4">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="card-box">
                            <h4 class="header-title mb-4">Members</h4>

                            <div class="table-responsive">
                                <table class="table table-hover table-centered m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-primary">{{ $member->first_name[0] }}</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">{{ $member->first_name }} </h5>
                                                <p class="m-0 text-muted"><small>{{ $member->last_name }}</small></p>
                                            </td>
                                            <td>
                                                <a href="tel:+{{ $member->phone_number }}">{{ $member->phone_number }}</a>
                                            </td>
                                            <td>{{ $member->email }}</td>
                                            <td>{{ $member->role }}</td>
                                            <td>{{ $member->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.edit', ['id' => $member->id]) }}">
                                                    <button class="btn btn-info">Edit</button>
                                                </a>
                                                <a href="{{ route('admin.user.delete', ['id' => $member->id]) }}">
                                                    <button class="btn btn-danger">Remove</button>
                                                </a>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
