@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="page-title-box">
                            <h3 class="page-title">Visitors ({{ $visitors_count }})</h3>
                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <a href="{{ route('admin.visitors.clear') }}">
                                        <button class="btn btn-danger">Clear</button>
                                    </a>
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>

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
                
                {{ $visitors->links('pagination::bootstrap-4') }}
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Here are logs boss!</h4>

                            <div class="table-responsive">
                                <table class="table table-hover table-centered m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>IP Address</th>
                                            <th>Request Path</th>
                                            <th>User Agent</th>
                                            <th>Datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visitors as $key => $visitor)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <td>{{ $visitor->ip_address }}</td>
                                            <td>{{ $visitor->request_path }}</td>
                                            <td>{{ $visitor->user_agent }}</td>
                                            <td>{{ $visitor->created_at }}</td>
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
