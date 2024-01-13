@extends('home/layouts/main')

@section('css')
    <style>
        .header {
            display: none;
        }

        .footer {
            display: none;
        }

        body {
            background-image: url('{{ asset('assets/images/backgrounds/login-bg.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
@endsection

@section('content')
<div class="login-page pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17 h-100">
    <div class="container">
        <div class="form-box">
            @include('messages')
            <div class="form-tab">
                <div class="tab-content">
                    <div class="tab-pane fade active show">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Username or email address *</label>
                                <input type="text" class="form-control" id="email" name="email" required="">
                            </div>

                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" required="">
                            </div>
                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <a href="#" class="forgot-link">Forgot Your Password?</a>
                            </div>
                        </form>
                        <div class="form-choice">
                            <p class="text-center">Don't have account? <a href="{{ route('register') }}">Register</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
