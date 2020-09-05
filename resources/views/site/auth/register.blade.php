@extends('site.layouts.app')

@section('content')

    <div class="page-breadcrumb breadcrumb-contact">

        <div class="container">

            <div class="breadcrumb-center d-table">

                <h3>{{ __('Register') }}</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">{{ __('Register') }}</li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>

    <div class="page-contact">

        <div class="container">

            <div class="row">

                <div class="offset-md-3 col-md-6">

                    <form class="form-contact" method="POST" action="{{ route('site::register') }}">
                        @csrf

                        <div class="form-row">

                            <input id="firstname" type="text" placeholder="{{ __('First name') }}"
                                   class="form-control @error('firstname') is-invalid @enderror"
                                   name="firstname" value="{{ old('firstname') }}" required
                                   autocomplete="firstname" autofocus>

                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="lastname" type="text" placeholder="{{ __('Last name') }}"
                                   class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                   value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="male" value="m" name="gender">
                                <label class="custom-control-label" for="male">{{ __('Male') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="female" value="f" name="gender">
                                <label class="custom-control-label" for="female">{{ __('Female') }}</label>
                            </div>

                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-row">

                            <input id="age" type="number" placeholder="{{ __('Age') }}"
                                   class="form-control @error('age') is-invalid @enderror" name="age"
                                   value="{{ old('age') }}" required autocomplete="age" autofocus>

                            @error('age')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-row">

                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="mobile" type="text" placeholder="{{ __('Mobile') }}"
                                   class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                   value="{{ old('mobile') }}" required autocomplete="mobile">

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <select id="country" type="text" placeholder="{{ __('Country') }}"
                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type @error('country') is-invalid @enderror" name="country"
                                     required autocomplete="country">
                                @foreach($countries as $country)
                                    <option value="{{$country->name}}" {{ old('country') == $country->name ? 'selected' : '' }}>{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="city" type="text" placeholder="{{ __('City') }}"
                                   class="form-control @error('city') is-invalid @enderror" name="city"
                                   value="{{ old('city') }}" required autocomplete="city">

                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="birthday" type="date" placeholder="{{ __('birth_day') }}"
                                   class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                   value="{{ old('birthday') }}" required autocomplete="birthday">

                            @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="address" type="text" placeholder="{{ __('Address') }}"
                                   class="form-control @error('address') is-invalid @enderror" name="address"
                                   value="{{ old('address') }}" required autocomplete="address">

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        {{--                        <div class="form-row">--}}

                        {{--                            <input id="post_code" type="text" placeholder="{{ __('Post_code') }}"--}}
                        {{--                                   class="form-control @error('post_code') is-invalid @enderror" name="post_code"--}}
                        {{--                                   value="{{ old('post_code') }}" required autocomplete="post_code">--}}

                        {{--                            @error('post_code')--}}
                        {{--                            <span class="invalid-feedback" role="alert">--}}
                        {{--                                        <strong>{{ $message }}</strong>--}}
                        {{--                                    </span>--}}
                        {{--                            @enderror--}}

                        {{--                        </div>--}}

                        <div class="form-row">

                            <input id="password" type="password" placeholder="{{ __('Password') }}"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-row">

                            <input id="password-confirm" type="password" class="form-control"
                                   placeholder="{{ __('Confirm Password') }}"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="send">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
