@extends('admin.layouts.app')



@section('content')



<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Add category')}}</h4>

                <h6 class="card-subtitle"> {{__('Add category description')}} </h6>



                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::category.store') }}" enctype="multipart/form-data">

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

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                            <label for="description" class="col-md-4 control-label">{{__('Description')}}</label>

                            <div class="col-md-12">

                                <textarea id="description" type="text" class="form-control" name="description">{{old('description')}}</textarea>

                                @if ($errors->has('description'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('description') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">

                            <label for="category_id" class="col-md-4 control-label">{{__('Category')}}</label>

                            <div class="col-md-12">

                                <select id="category_id" type="file" class="form-control" name="category_id"  required>

                                    <option value="0">{{__('Default')}}</option>

                                    @foreach(\App\Category::get() as $cat)

                                        <option value="{{$cat->id}}"
                                            @if(old('category_id'))
                                                {{$cat->id == old('category_id') ? "selected" : ""}}
                                            @endif
                                        >{{$cat->name}}</option>

                                    @endforeach

                                </select>

                                @if ($errors->has('category_id'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('category_id') }}</strong>

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

