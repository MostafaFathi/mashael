@extends('admin.layouts.app')

@section('header')
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/bootstrap-datetimepicker.min.css">
@endsection

@section('content')

    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">{{__('Add session')}}</h4>

                    <h6 class="card-subtitle"> {{__('Add session description')}} </h6>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('admin::session.store') }}"
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

                                    <textarea id="description" name="description">{{old('description')}}</textarea>

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
                                        @foreach(\App\Trainer::get() as $trainer)
                                            <option
                                                value="{{$trainer->id}}" {{old('trainer_id') == $trainer->id ? "selected" : ""}}>
                                                {{$trainer->id}} - {{$trainer->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('trainer_id'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('trainer_id') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

{{--                             <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">

                                <label for="price" class="col-md-4 control-label">{{__('Price')}}</label>

                                <div class="col-md-12">

                                    <input id="price" type="text" class="form-control" name="price"
                                           value="{{old('price')}}" required>

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

                                    <input id="date_time" type="text" class="form-control datetimepicker" name="date_time"
                                           value="{{old('date_time')}}" placeholder="{{date("Y-m-d H:i:s")}}" required>

                                    @if ($errors->has('date_time'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('date_time') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>
{{--                             <div class="form-group{{ $errors->has('date_time_end') ? ' has-error' : '' }}">

                                <label for="date_time_end" class="col-md-4 control-label">{{__('Date & time to')}}</label>

                                <div class="col-md-12">

                                    <input id="date_time_end" type="text" class="form-control datetimepicker" name="date_time_end"
                                           value="{{old('date_time_end')}}" placeholder="{{date("Y-m-d H:i:s")}}" required>

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
                                           value="{{old('contact_by')}}" required>

                                    @if ($errors->has('contact_by'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('contact_by') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">

                                <label for="address" class="col-md-4 control-label">{{__('Address')}}  <span class="badge badge-danger">في حال كانت الجلسة حضوري</span></label>

                                <div class="col-md-12">

                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{old('address')}}" required>

                                    @if ($errors->has('address'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('address') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div class="form-group">

                                    <button type="submit" class="btn btn-primary">

                                        {{__('Save')}}

                                    </button>


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
