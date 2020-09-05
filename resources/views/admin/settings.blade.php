@extends('admin.layouts.app')



@section('content')



    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">{{__('Settings')}}</h4>

                    <h6 class="card-subtitle"> {{__('Settings description')}} </h6>


                    <div class="row">

                        <form class="col-md-6" action="{{route('admin::settings')}}" method="post"
                              enctype="multipart/form-data">

                            {{csrf_field()}}


                            <div class="form-group">
                                <img src="{{url('storage/app').'/'.\App\Setting::getValue('logo')}}">
                                <label class="control-label" for="logo">{{__('Site logo')}}</label>
                                <input type="file" class="form-control" id="logo" name="logo" >
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="name">{{__('Site name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{\App\Setting::getValue('name')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">{{__('Site Email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{\App\Setting::getValue('email')}}">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="whatsapp">{{__('Site Whatsapp')}}</label>
                                <input type="whatsapp" class="form-control" id="whatsapp" name="whatsapp"
                                       value="{{\App\Setting::getValue('whatsapp')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="phone">{{__('Phone')}}</label>
                                <input type="phone" class="form-control" id="phone" name="phone"
                                       value="{{\App\Setting::getValue('phone')}}">
                            </div>

                             <div class="form-group">
                                <label class="control-label" for="fax">{{__('Fax')}}</label>
                                <input type="fax" class="form-control" id="fax" name="fax"
                                       value="{{\App\Setting::getValue('fax')}}">
                            </div>

                             <div class="form-group">
                                <label class="control-label" for="address">{{__('Address')}}</label>
                                <input type="address" class="form-control" id="address" name="address"
                                       value="{{\App\Setting::getValue('address')}}">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="whatsapp">{{__('Location on map')}}</label>
                                <div id="map_canvas" class="maps" style="width:100%; height:300px;"></div>
                                <input type="hidden1" name="location" id="location" value="{{\App\Setting::getValue('location')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label"
                                       for="Years_of_experience">{{__('Years of experience')}}</label>
                                <input type="Years_of_experience" class="form-control" id="Years_of_experience"
                                       name="Years_of_experience"
                                       value="{{\App\Setting::getValue('Years_of_experience')}}">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="Training_course">{{__('Training course')}}</label>
                                <input type="Training_course" class="form-control" id="Training_course"
                                       name="Training_course" value="{{\App\Setting::getValue('Training_course')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="Workshop">{{__('Training course')}}</label>
                                <input type="Workshop" class="form-control" id="Workshop" name="Workshop"
                                       value="{{\App\Setting::getValue('Workshop')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="Book_and_article">{{__('Book and article')}}</label>
                                <input type="Book_and_article" class="form-control" id="Book_and_article"
                                       name="Book_and_article" value="{{\App\Setting::getValue('Book_and_article')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="clients">{{__('Clients')}}</label>
                                <input type="clients" class="form-control" id="clients"
                                       name="clients" value="{{\App\Setting::getValue('clients')}}">
                            </div>

                            <hr>

                            <div class="form-group">
                                <label class="control-label" for="facebook">{{__('Facebook')}}</label>
                                <input type="facebook" class="form-control" id="facebook" name="facebook"
                                       value="{{\App\Setting::getValue('facebook')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="twitter">{{__('Twitter')}}</label>
                                <input type="twitter" class="form-control" id="twitter" name="twitter"
                                       value="{{\App\Setting::getValue('twitter')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="linkedin">{{__('Linkedin')}}</label>
                                <input type="linkedin" class="form-control" id="linkedin" name="linkedin"
                                       value="{{\App\Setting::getValue('linkedin')}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="youtube">{{__('Youtube')}}</label>
                                <input type="youtube" class="form-control" id="youtube" name="youtube"
                                       value="{{\App\Setting::getValue('youtube')}}">
                            </div>


                            <div class="form-group">
                                <button class="btn btn-success">{{__('Save')}}</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection



@section('footer')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=ar"></script>
    <script type="text/javascript">
        function initialize() {
            var stockholm = new google.maps.LatLng{{\App\Setting::getValue('location')}};
            var parliament = new google.maps.LatLng{{\App\Setting::getValue('location')}};
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
                $("#location").val(pp).keyup();
                map.setCenter(marker.getPosition());

            });
        }

        initialize();
    </script>
@endsection
