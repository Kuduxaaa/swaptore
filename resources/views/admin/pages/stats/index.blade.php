@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        
                        <div class="page-title-box">
                            <h4 class="page-title">Statistics</h4>
                            
                        </div>
                    </div>
                </div>

                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <h1>yleo</h1>
            </div>
        </div>
    </div>
@endsection
