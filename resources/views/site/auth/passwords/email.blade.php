@extends('site.layouts.app')

@section('content')

    <div class="page-breadcrumb breadcrumb-contact">

        <div class="container">

            <div class="breadcrumb-center d-table">

            <h3>{{ __('Reset Password') }}</h3>

                <nav>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">{{ __('Reset Password') }}</li>
                    </ol>
                </nav>
            </div>
            
        </div>

    </div>

    <div class="page-contact">

        <div class="container">

            <div class="row">
                {{session('success')}}
                <div class="offset-md-3 col-md-6">

                    <form class="form-contact" method="POST" action="{{ route('site::password.email') }}">
                        @csrf

                        <div class="form-row">
                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-row mb-0">

                            <button type="submit" class="send">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>

                        <div class="request-pass">
                            <a href="{{ route('site::login') }}"><i class="fas fa-info-circle"></i> تسجيل الدخول</a>
                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
