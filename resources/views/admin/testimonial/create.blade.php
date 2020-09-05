@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Add testimonial')}}</h4>

                <h6 class="card-subtitle"> {{__('Add testimonial description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::testimonial.store') }}" enctype="multipart/form-data">

						{{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>

                            <div class="col-md-12">

                                <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required>

                                @if ($errors->has('name'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

{{--                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">--}}

{{--                            <label for="birthday" class="col-md-4 control-label">{{__('Birthday')}}</label>--}}

{{--                            <div class="col-md-12">--}}

{{--                                <input id="birthday" type="text" class="form-control" name="birthday" value="{{old('birthday')}}" required>--}}

{{--                                @if ($errors->has('birthday'))--}}

{{--                                    <span class="help-block">--}}

{{--                                        <strong>{{ $errors->first('birthday') }}</strong>--}}

{{--                                    </span>--}}

{{--                                @endif--}}

{{--                            </div>--}}

{{--                        </div>--}}

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                            <label for="description" class="col-md-4 control-label">{{__('Description')}}</label>

                            <div class="col-md-12">

                                <textarea id="description" type="text" class="form-control" name="description" required>{{old('description')}}</textarea>

                                @if ($errors->has('description'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('description') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                            <label for="image" class="col-md-4 control-label">{{__('Image')}}</label>

                            <div class="col-md-12">

                                <input id="image" type="file" class="form-control" name="image"  required>

                                @if ($errors->has('image'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('image') }}</strong>

                                    </span>

                                @endif

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

