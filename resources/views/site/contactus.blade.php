@extends('site.layouts.app')

@section('title',$page->name)

@section('content')

    <div class="page-breadcrumb breadcrumb-contact">

        <div class="container">

            <div class="breadcrumb-center d-table">

                <h3>اتصل بنا</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">اتصل بنا</li>
                    </ol>
                </nav>

            </div>

        </div>

    </div>

    <section class="page-contact">

        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-md-6">

                    <div class="info-contact">

                        <h3>{{$page->name}}</h3>

                        <p>{!!$page->description!!}</p>

                        <ul>
                            <li><i class="fas fa-phone"></i> <span>{{ \App\Setting::getValue('phone') }}</span> </li>
                            <li><i class="far fa-envelope"></i> <span>{{ \App\Setting::getValue('email') }}</span> </li>
                            <li><i class="fas fa-fax"></i> <span>{{ \App\Setting::getValue('fax') }}</span> </li>
                            <li><i class="fas fa-map-marker-alt"></i> <span>{{ \App\Setting::getValue('address') }}</span> </li>
                        </ul>

                    </div>

                </div>

                <div class="col-lg-7 col-md-6">


                    <div class="form-contact">

                        <h3>ضع سؤالك ولا تتردد</h3>

                        <form method="post" action="{{route('site::contactus')}}">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control"  name="first_name" placeholder="الإسم الأول" value="{{old('first_name')}}">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="last_name" placeholder="الإسم الأخير" value="{{old('last_name')}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <input type="email" class="form-control" name="email" placeholder="البريد الإلكتروني" value="{{old('email')}}">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="موضوع الرسالة" value="{{old('title')}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <textarea class="form-control" name="message" placeholder="نص الرسالة هنا">{{old('message')}}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="send">إرسال </button>

                        </form>

                    </div>

                </div>

            </div>


        </div>

        <div class="map">

            <div class="mapouter">
                <div class="gmap_canvas">
                    <div id="map_canvas" class="maps" style="width:100%; height:370px;"></div>
                </div>
            </div>

        </div>

    </section>

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
                draggable: false,
                animation: google.maps.Animation.DROP,
                position: parliament
            });

        }

        initialize();
    </script>

@endsection
