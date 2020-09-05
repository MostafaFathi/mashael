@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Edit question')}}</h4>

                <h6 class="card-subtitle"> {{__('Edit question description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('admin::question.update',$question->id) }}" enctype="multipart/form-data">

						{{ csrf_field() }}

						{{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>

                            <div class="col-md-12">

                                <input id="name" type="text" class="form-control" name="name" value="{{$question->title}}" required>

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

                                <textarea id="description"  name="description">{{$question->question}}</textarea>
                                @if ($errors->has('description'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('description') }}</strong>

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

                    @foreach($question->answers as $answer)
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">

                            <label for="url" class="col-md-4 control-label">{{__('Answer')}}</label>

                            <div class="col-md-12">

                                <p>{!! $answer->answer !!}</p>
                            </div>
                        </div>
                    @endforeach

                    <form class="form-horizontal" method="POST" action="{{ route('admin::answer.store') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <input type="hidden" name="question_id" value="{{$question->id}}">

                        <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">

                            <label for="answer" class="col-md-4 control-label">{{__('Description')}}</label>
                            <div class="col-md-12">

                                <textarea id="answer" value=""  name="answer"></textarea>

                                @if ($errors->has('answer'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('answer') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-8 col-md-offset-4">

                                <button type="submit" class="btn btn-primary">

                                    {{__('Add Answer')}}

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

