@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Add certificate')}}</h4>

                <h6 class="card-subtitle"> {{__('Add certificate description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::certificate.store') }}" enctype="multipart/form-data">

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

<!--                         <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">

                            <label for="url" class="col-md-4 control-label">{{__('Url')}}</label>

                            <div class="col-md-12">

                                <input id="url" type="text" class="form-control" name="url" value="{{old('url')}}" required>

                                @if ($errors->has('url'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('url') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>
 -->
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

