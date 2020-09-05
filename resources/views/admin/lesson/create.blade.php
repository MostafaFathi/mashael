@extends('admin.layouts.app')

@section('content')

    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">{{__('Add lesson')}}</h4>

                    <h6 class="card-subtitle"> {{__('Add lesson description')}} </h6>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('admin::lesson.store') }}"
                              enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>

                                <div class="col-md-12">

                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{old('name')}}" required>

                                    @if ($errors->has('name'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                <label for="description" class="col-md-4 control-label">{{__('Description')}}</label>

                                <div class="col-md-12">

                                    <textarea id="description" type="text" class="form-control"
                                              name="description">{{old('description')}}</textarea>

                                    @if ($errors->has('description'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('description') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">

                                <label for="time" class="col-md-4 control-label">{{__('Time')}}</label>

                                <div class="col-md-12">

                                    <input id="time" type="text" class="form-control" name="time"
                                           value="{{old('time') ? old('time') : '00:00:00'}}" placeholder="00:00:00">

                                    @if ($errors->has('time'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('time') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('video_url') ? ' has-error' : '' }}">

                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="video_url"
                                                   class="col-md-4 control-label">{{__('Video file')}}</label>
                                        </div>
                                        <div class="col-md-2 text-center">

                                        </div>
                                        <div class="col-md-5">
                                            <label for="video_url"
                                                   class="control-label">{{__('Video url')}} {{__('EX')}}:{{__('Youtube')}},{{__('Facebook')}},{{__('Vimeo')}}</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input id="video_file" type="file" class="form-control" name="video_file">
                                        </div>
                                        <div class="col-md-2 text-center">
                                            Or
                                        </div>
                                        <div class="col-md-5">
                                            <input id="video_url" type="text" class="form-control" name="video_url"
                                                   value="{{old('video_url')}}">
                                        </div>

                                    </div>

                                    @if ($errors->has('video_url'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('video_url') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">

                                <label for="course_id" class="col-md-4 control-label">{{__('Course')}}</label>

                                <div class="col-md-12">

                                    <select id="course_id" type="file" class="form-control" name="course_id" required>

                                        @foreach(\App\Course::get() as $course)

                                            <option value="{{$course->id}}"
                                            @if(old('course_id'))
                                                {{in_array($course->id,old('course_id')) ? "selected" : ""}}
                                                @endif
                                            >{{$course->name}}
                                            </option>

                                        @endforeach

                                    </select>

                                    @if ($errors->has('course_id'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('course_id') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">

                                <label for="type_id" class="col-md-4 control-label">{{__('Type')}}</label>

                                <div class="col-md-12">

                                    <select id="type_id" type="file" class="form-control" name="type_id" required>

                                        @foreach(\App\Type::get() as $type)

                                            <option value="{{$type->id}}"
                                            @if(old('type_id'))
                                                {{in_array($type->id,old('type_id')) ? "selected" : ""}}
                                                @endif
                                            >{{$type->name}}
                                            </option>

                                        @endforeach

                                    </select>

                                    @if ($errors->has('type_id'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('type_id') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                                <label for="image" class="col-md-4 control-label">{{__('Image')}}</label>

                                <div class="col-md-12">

                                    <input id="image" type="file" class="form-control" name="image" required>

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

