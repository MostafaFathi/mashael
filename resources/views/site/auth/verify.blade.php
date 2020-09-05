@extends('layouts.app')

@section('content')

    <div class="page-breadcrumb breadcrumb-contact">

        <div class="container">

            <div class="breadcrumb-center d-table">

            <h3>{{ __('Verify Your Email Address') }}</h3>

                <nav>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">{{ __('Verify Your Email Address') }}</li>
                    </ol>
                </nav>
            </div>
            
        </div>

    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a
                            href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
