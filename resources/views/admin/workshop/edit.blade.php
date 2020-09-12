@extends('admin.layouts.app')

@section('header')
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/bootstrap-datetimepicker.min.css">
@endsection


@section('content')

    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">{{__('Edit workshop')}}</h4>

                    <h6 class="card-subtitle"> {{__('Edit workshop description')}} </h6>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST"
                              action="{{ route('admin::workshop.update',$workshop->id) }}"
                              enctype="multipart/form-data">

                            {{ csrf_field() }}

                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('slider') ? ' has-error' : '' }}">

                                <div class="col-md-12">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="slider" name="slider"
                                               {{$workshop->slider > 0 ? "checked" : "" }}  value="1">
                                        <label class="custom-control-label"
                                               for="slider">{{__('Show on slider')}}</label>
                                    </div>

                                    @if ($errors->has('slider'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('slider') }}</strong>

                                    </span>

                                    @endif

                                </div>


                            </div>

                            <div class="form-group{{ $errors->has('sliderImage') ? ' has-error' : '' }}">

                                <label for="sliderImage" class="col-md-4 control-label">{{__('Image')}}</label>

                                <div class="col-md-12">

                                    @if($workshop->sliderImage)
                                        <img src="{{url('storage/app/'.$workshop->sliderImage)}}">
                                    @endif

                                    <input id="sliderImage" type="file" class="form-control" name="sliderImage">

                                    @if ($errors->has('sliderImage'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('sliderImage') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>

                                <div class="col-md-12">

                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{$workshop->name}}" required>

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

                                    <textarea id="description" name="description">{{$workshop->description}}</textarea>

                                    @if ($errors->has('description'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('description') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">

                                <label for="intro" class="col-md-4 control-label">{{__('Intro video')}}</label>

                                <div class="col-md-12">

                                    <input id="intro" type="text" class="form-control" name="intro"
                                           value="{{$workshop->intro}}" required>

                                    @if ($errors->has('intro'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('intro') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('intro_image') ? ' has-error' : '' }}">

                                <label for="intro_image" class="col-md-4 control-label">{{__('Intro Image')}}</label>

                                <div class="col-md-12">

                                    <input id="intro_image" type="text" class="form-control" name="intro_image"
                                           value="{{$workshop->intro_image}}" required>

                                    @if ($errors->has('intro_image'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('intro_image') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">

                                <label for="category_id" class="col-md-4 control-label">{{__('Category')}}</label>

                                <div class="col-md-12">
                                    <select id="category_id" type="file" class="form-control" name="category_id[]"
                                            multiple required>

                                        @foreach(\App\Category::get() as $cat)

                                            <option value="{{$cat->id}}"
                                            @if($workshop->categories and $workshop->categories->pluck('id'))
                                                {{ in_array($cat->id,$workshop->categories->pluck('id')->toArray()) ? "selected" : "" }}
                                                @endif
                                            >{{$cat->name}}
                                            </option>

                                        @endforeach

                                    </select>

                                    @if ($errors->has('category_id'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('category_id') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('trainer_id') ? ' has-error' : '' }}"
                                 style="display: none">

                                <label for="trainer_id" class="col-md-4 control-label">{{__('Trainer')}}</label>

                                <div class="col-md-12">

                                    <select id="trainer_id" type="text" class="form-control" name="trainer_id">
                                        @foreach(\App\Trainer::get() as $type)
                                            <option
                                                value="{{$type->id}}" {{$workshop->trainer_id == $type->id ? "selected" : ""}}>
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

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                                <label for="image" class="col-md-4 control-label">{{__('Image')}}</label>

                                <div class="col-md-12">

                                    @if($workshop->image)
                                        <img src="{{url('storage/app/'.$workshop->image)}}">
                                    @endif

                                    <input id="image" type="file" class="form-control" name="image">

                                    @if ($errors->has('image'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('image') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">

                                <label for="type_id" class="col-md-4 control-label">{{__('Type')}}</label>

                                <div class="col-md-12">

                                    <select id="type_id" type="text" class="form-control" name="type_id">
                                        @foreach(\App\Type::get() as $type)
                                            <option
                                                value="{{$type->id}}" {{$workshop->type_id == $type->id ? "selected" : ""}}>{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('type_id'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('type_id') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">

                                <label for="price"
                                       class="col-md-4 control-label">{{__('The price for one person')}}</label>

                                <div class="col-md-12">

                                    <input id="price" type="text" class="form-control" name="price"
                                           value="{{$workshop->price}}" required>

                                    @if ($errors->has('price'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('price') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('price2') ? ' has-error' : '' }}">

                                <label for="price2"
                                       class="col-md-4 control-label">{{__('Price for more than one person')}}</label>

                                <div class="col-md-12">

                                    <input id="price2" type="text" class="form-control" name="price2"
                                           value="{{$workshop->price2}}" required>

                                    @if ($errors->has('price2'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('price2') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('persons') ? ' has-error' : '' }}">

                                <label for="persons" class="col-md-4 control-label">{{__('Persons')}} <span
                                        class="badge badge-danger">{{__('0 is unlimited')}}</label>

                                <div class="col-md-12">

                                    <input id="persons" type="text" class="form-control" name="persons"
                                           value="{{$workshop->persons}}" required>

                                    @if ($errors->has('persons'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('persons') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">

                                <label for="date_time" class="col-md-4 control-label">{{__('Date from')}}</label>

                                <div class="col-md-12">

                                    <input id="date_time" type="text" class="form-control datetimepicker"
                                           name="date_time"
                                           value="{{$workshop->date_time}}" placeholder="{{date("Y-m-d H:i:s")}}"
                                           required>

                                    @if ($errors->has('date_time'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('date_time') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('date_time_to') ? ' has-error' : '' }}">

                                <label for="date_time_to" class="col-md-4 control-label">{{__('Date to')}}</label>

                                <div class="col-md-12">

                                    <input id="date_time_to" type="text" class="form-control datetimepicker" name="date_time_to"
                                           value="{{$workshop->date_time_to}}" placeholder="{{date("Y-m-d H:i:s")}}" required>

                                    @if ($errors->has('date_time_to'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('date_time_to') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">

                                <label for="address" class="col-md-4 control-label">{{__('Text location')}}</label>

                                <div class="col-md-12">

                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{$workshop->address}}" required>

                                    @if ($errors->has('address'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('address') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>


                            <div id="map_canvas" class="maps" style="width:100%; height:300px;"></div>
                            <input type="hidden" name="coordinates" id="coordinates">


                            <div class="form-group{{ $errors->has('register_status') ? ' has-error' : '' }}">

                                <div class="col-md-12">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="register_status"
                                               name="register_status"
                                               {{$workshop->register_status == 0 ? "checked" : "" }}  value="0">
                                        <label class="custom-control-label"
                                               for="register_status">{{__('Disabled register')}}</label>
                                    </div>

                                    @if ($errors->has('register_status'))

                                        <span class="help-block">

                                        <strong>{{ $errors->first('register_status') }}</strong>

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

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=ar"></script>
    <script type="text/javascript">
        function initialize() {
            var stockholm = new google.maps.LatLng{{$workshop->coordinates ? $workshop->coordinates : \App\Setting::getValue('location') }};
            var parliament = new google.maps.LatLng{{$workshop->coordinates ? $workshop->coordinates : \App\Setting::getValue('location') }};
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
