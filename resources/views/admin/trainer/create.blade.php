@extends('admin.layouts.app')



@section('content')



<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Add trainer')}}</h4>

                <h6 class="card-subtitle"> {{__('Add trainers description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::trainer.store') }}">

						{{ csrf_field() }}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">

                            <label for="firstname" class="col-md-4 control-label">{{__('First name')}}</label>

                            <div class="col-md-12">

                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{old('firstname')}}" required>

                                @if ($errors->has('firstname'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('firstname') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">

                            <label for="lastname" class="col-md-4 control-label">{{__('Last name')}}</label>

                            <div class="col-md-12">

                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{old('lastname')}}" required>

                                @if ($errors->has('lastname'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('lastname') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <label for="email" class="col-md-4 control-label">{{__('Email')}}</label>

                            <div class="col-md-12">

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" value="{{old('email')}}" required>

                                @if ($errors->has('email'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <label for="password" class="col-md-4 control-label">{{__('Password')}}</label>

                            <div class="col-md-12">

                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                            <label for="password_confirmation" class="col-md-4 control-label">{{__('Password confirmation')}}</label>

                            <div class="col-md-12">

                                <input id="password_confirmation" type="password_confirmation" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" >

                                @if ($errors->has('password_confirmation'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password_confirmation') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">

                            <label for="notes" class="col-md-4 control-label">{{__('Notes')}}</label>

                            <div class="col-md-12">

                                <textarea id="notes" type="text" class="form-control" name="notes">{{old('notes')}}</textarea>

                                @if ($errors->has('notes'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('notes') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-md-offset-4">

                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" name="status" {{ old('status') == "Active" ? 'checked="checked"' : '' }}> {{__('Status')}}

                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-8 col-md-offset-4">

                                <button type="submit" class="btn btn-primary">

                                    {{__('Save')}}

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

