@extends('admin/layouts/main')

@section('css')
<style>.alert{margin:0px 0px 0px 0px;}</style>    
@endsection

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                
                @if(session('message'))
                    <div class="alert alert-success mt-4">
                        {{ session('message') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mt-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8 mt-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Categories</h4>

                            <div class="table-responsive">
                                <table class="table table-hover table-centered m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Products Count</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->products_count }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.categories.delete', ['id' => $category->id]) }}">
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

                    <div class="col-md-4 mt-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Add Category</h4>

                            <form action="{{ route('admin.categories.add') }}" method="post">
                                @csrf 

                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" name="name" placeholder="Enter category name">
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Create category</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
