@extends('admin.layouts.app')

@section('header')
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/bootstrap-datetimepicker.min.css">
@endsection

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">{{__('Edit session')}}</h4>

                <h6 class="card-subtitle"> {{__('Edit session description')}} </h6>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST"
                          action="{{ route('admin::session.update',$session->id) }}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>

                            <div class="col-md-12">

                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{$session->name}}" required>

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

                                <textarea id="description" name="description">{{$session->description}}</textarea>`

                                @if ($errors->has('description'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('description') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('trainer_id') ? ' has-error' : '' }}" style="display: none">

                            <label for="trainer_id" class="col-md-4 control-label">{{__('Trainer')}}</label>

                            <div class="col-md-12">

                                <select id="trainer_id" type="text" class="form-control" name="trainer_id">
                                    @foreach(\App\Trainer::get() as $type)
                                        <option
                                            value="{{$type->id}}" {{$session->trainer_id == $type->id ? "selected" : ""}}>
                                            {{$type->id}} - {{$type->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('trainer_id'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('trainer_id') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

{{--                         <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">

                            <label for="price" class="col-md-4 control-label">{{__('Price')}}</label>

                            <div class="col-md-12">

                                <input id="price" type="text" class="form-control" name="price"
                                       value="{{$session->price}}" required>

                                @if ($errors->has('price'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('price') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>
 --}}
                        <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">

                            <label for="date_time" class="col-md-4 control-label">{{__('Date & time from')}}</label>

                            <div class="col-md-12">

                                <input id="date_time" type="text" class="form-control datetimepicker"
                                       name="date_time"
                                       value="{{$session->date_time}}" placeholder="{{date("Y-m-d H:i:s")}}"
                                       required>

                                @if ($errors->has('date_time'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('date_time') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>

{{--                         <div class="form-group{{ $errors->has('date_time_end') ? ' has-error' : '' }}">

                            <label for="date_time_end" class="col-md-4 control-label">{{__('Date & time to')}}</label>

                            <div class="col-md-12">

                                <input id="date_time_end" type="text" class="form-control datetimepicker"
                                       name="date_time_end"
                                       value="{{$session->date_time_end}}" placeholder="{{date("Y-m-d H:i:s")}}"
                                       required>

                                @if ($errors->has('date_time_end'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('date_time_end') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>
 --}}



                        <div class="form-group{{ $errors->has('contact_by') ? ' has-error' : '' }}">

                            <label for="contact_by" class="col-md-4 control-label">{{__('Contact By')}} <span class="badge badge-danger">في حال كانت الجلسة أونلاين</span></label>

                            <div class="col-md-12">

                                <input id="contact_by" type="text" class="form-control" name="contact_by"
                                       value="{{$session->contact_by}}" required>

                                @if ($errors->has('contact_by'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('contact_by') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">

                            <label for="address" class="col-md-4 control-label">{{__('Address')}} <span class="badge badge-danger">في حال كانت الجلسة حضوري</span></label>

                            <div class="col-md-12">

                                <input id="address" type="text" class="form-control" name="address"
                                       value="{{$session->address}}" required>

                                @if ($errors->has('address'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('address') }}</strong>

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

@section('footer')

     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="{{url('WhiteAdmin')}}/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
@endsection
