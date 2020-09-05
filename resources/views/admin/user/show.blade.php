@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Show details')}}</h4>

                <h6 class="card-subtitle"> {{__('Edit users description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::user.update',$user->id) }}">

						{{ csrf_field() }}

						{{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">

                            <label for="firstname" class="col-md-4 control-label font-weight-bold">{{__('First name')}}</label>

                            <div class="col-md-12">

                                {{$user->firstname ?? '--'}}

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">

                            <label for="lastname" class="col-md-4 control-label font-weight-bold">{{__('Last name')}}</label>

                            <div class="col-md-12">
                                {{$user->lastname ?? '--'}}
                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">

                            <label for="gender" class="col-md-4 control-label font-weight-bold">{{__('Gender')}}</label>

                            <div class="col-md-12">
                                {{$user->gender_name ?? '--'}}
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">

                            <label for="age" class="col-md-4 control-label font-weight-bold">{{__('Age')}}</label>

                            <div class="col-md-12">
                                {{$user->age ?? '--'}}
                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">

                            <label for="country" class="col-md-4 control-label font-weight-bold">{{__('Country')}}</label>

                            <div class="col-md-12">
                                {{$user->country ?? '--'}}
                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">

                            <label for="city" class="col-md-4 control-label font-weight-bold">{{__('City')}}</label>

                            <div class="col-md-12">
                                {{$user->city ?? '--'}}
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <label for="email" class="col-md-4 control-label font-weight-bold">{{__('Email')}}</label>

                            <div class="col-md-12">
                                {{ $user->email ?? '--' }}
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">

                            <label for="notes" class="col-md-4 control-label font-weight-bold">{{__('Notes')}}</label>

                            <div class="col-md-12">

                                {!! $user->notes ?? '--' !!}

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-md-offset-4">

                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" disabled name="status" {{ $user->status == "Active" ? 'checked="checked"' : '' }}> {{__('Status')}}

                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('lastlogin') ? ' has-error' : '' }}">

                            <label for="lastlogin" class="col-md-4 control-label font-weight-bold">{{__('Last login')}}</label>

                            <div class="col-md-12">

                               {{$user->lastlogin ?? '--'}}

                            </div>

                        </div>

<!--                         <div class="form-group{{ $errors->has('lastlogin') ? ' has-error' : '' }}">

                            <label for="lastlogin" class="col-md-4 control-label">{{__('Ip')}}</label>

                            <div class="col-md-12">

                                {{$user->ip}}

                            </div>

                        </div>
 -->
                        <div class="form-group{{ $errors->has('lastlogin') ? ' has-error' : '' }}">

                            <label for="lastlogin" class="col-md-4 control-label font-weight-bold">{{__('Created at')}}</label>

                            <div class="col-md-12">

                               {{$user->created_at ?? '--'}}

                            </div>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

