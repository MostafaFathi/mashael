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
                        <div class="form-group{{ $errors->has('session_type') ? ' has-error' : '' }}">

                            <label for="session_type" class="col-md-4 control-label">{{__('Type')}}</label>

                            <div class="col-md-12">

                                <select id="session_type" type="text" class="form-control session_type" name="session_type">
                                    @foreach($sessionTypes as $type)
                                        <option
                                            value="{{$type->id}}" {{$session->session_type == $type->id ? "selected" : ""}}>
                                            {{$type->id}} - {{$type->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('session_type'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('session_type') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">

                            <label for="date_time" class="col-md-4 control-label">{{__('Date')}}</label>

                            <div class="col-md-12">

                                <input id="date_time" type="text" class="form-control datetimepicker"
                                       name="date_time"
                                       value="{{$session->date_time}}" placeholder="{{date("Y-m-d")}}"
                                       required>

                                @if ($errors->has('date_time'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('date_time') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="form-group{{ $errors->has('interval_time') ? ' has-error' : '' }}">

                            <label for="interval_time" class="col-md-4 control-label">{{__('Interval')}}</label>

                            <div class="col-md-12">

                                <select id="interval_time" type="text" class="form-control" name="interval_time">
                                    @foreach($timeInterval as $item)
                                        <option
                                            value="{{$item}}" {{$session->interval_time == $item ? "selected" : ""}}>
                                            {{$item}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('interval_time'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('interval_time') }}</strong>

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
                                       value="{{$session->contact_by}}">

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
                                       value="{{$session->address}}">

                                @if ($errors->has('address'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('address') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>
                        <div id="map_canvas" class="maps" style="width:100%; height:300px;{{$session->session_type == 1 || $session->session_type==2 ? 'display:none' : ''}}"></div>
                        <input type="hidden" name="coordinates" id="coordinates">

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
                format: 'YYYY-MM-DD'
            });
        });
        $(".datetimepicker").on("dp.change", function (e) {

            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{route('admin::sessions.check.intervals')}}',
                data: {'date':$('#date_time').val(),'update':true,'session':@json($session)},
                cache: "false",
                success: function(data) {
                    $('#interval_time').html(data);
                    console.log(data);

                },error:function(data){

                }

            });
            return false;
        });
        $(document).on('change','.session_type',function () {
            if($(this).val() == 3 || $(this).val() == 4){
                $('#map_canvas').css('display','block');
            }else{
                $('#map_canvas').css('display','none');
            }
            return false;
        });
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=ar"></script>
     <script type="text/javascript">
         function initialize() {
             var stockholm = new google.maps.LatLng{{$session->coordinates ? $session->coordinates : \App\Setting::getValue('location') }};
             var parliament = new google.maps.LatLng{{$session->coordinates ? $session->coordinates : \App\Setting::getValue('location') }};
             $("#coordinates").val(stockholm);
             var mapOptions = {
                 zoom: 13,
                 mapTypeId: google.maps.MapTypeId.ROADMAP,
                 center: stockholm
             };
             map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
             marker = new google.maps.Marker({
                 map: map,
                 draggable: true,
                 animation: google.maps.Animation.DROP,
                 position: parliament
             });
             google.maps.event.addListener(marker, 'dragend', function () {
                 var pp = marker.getPosition();
                 $("#coordinates").val(pp).keyup();
                 map.setCenter(marker.getPosition());

             });
         }

         initialize();
     </script>
@endsection
