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

                <div class="offset-md-3 col-md-6">

                    <form class="form-contact" method="POST" action="{{ route('site::password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{request('token')}}">
                        <div class="form-row">
                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ request('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="password" type="password" placeholder="{{ __('Password') }}"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="password-confirmation" type="password" placeholder="{{ __('Password confirmation') }}"
                                   class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                   required>

                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="form-row mb-0">

                            <button type="submit" class="send">
                                {{ __('Reset Password') }}
                            </button>
                        </div>

                        <div class="request-pass">
                            <a href="{{ route('site::password.request') }}"><i class="fas fa-info-circle"></i> نسيت كلمة المرور؟</a>
                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
