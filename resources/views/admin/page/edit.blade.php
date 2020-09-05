@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Edit page')}}</h4>

                <h6 class="card-subtitle"> {{__('Edit page description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::page.update',$page->id) }}" enctype="multipart/form-data">

						{{ csrf_field() }}

						{{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>

                            <div class="col-md-12">

                                <input id="name" type="text" class="form-control" name="name" value="{{$page->name}}" required>

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

                                <textarea id="description" name="description">{{$page->description}}</textarea>

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

                                @if($page->image)
                                    <img style="width: 200px;" src="{{url('storage/app/'.$page->image)}}">
                                @endif
                                <input id="image" type="file" class="form-control" name="image">

                                @if ($errors->has('image'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('image') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">

                            <label for="url" class="col-md-4 control-label">{{__('Url')}}</label>

                            <div class="col-md-12">

                                <input id="url" type="text" class="form-control" name="url" value="{{$page->url}}">

                                @if ($errors->has('url'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('url') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">

                            <label for="slug" class="col-md-4 control-label">{{__('Slug')}}</label>

                            <div class="col-md-12">

                                <input id="slug" type="text" class="form-control" name="slug" value="{{$page->slug}}">

                                @if ($errors->has('slug'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('slug') }}</strong>

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


