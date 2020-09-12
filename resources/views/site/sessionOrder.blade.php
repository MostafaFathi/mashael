@extends('site.layouts.app')

@section('title' , $session->name  )

@section('content')

    <div class="page-breadcrumb breadcrumb-courses">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>الإشتراك في جلسة</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الإشتراك في جلسة</li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>

    <section class="page-payment">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div id="no-more-tables" class="table-pay">
                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                            <thead class="head">
                            <tr>
                                <th class="numeric">حجز جلسة</th>
                                <th class="numeric">السعر</th>
                            </tr>
                            </thead>
                            <tbody class="body-table">
                            <tr>
                                <td data-title="ورشة العمل المسجلة" class="numeric">


                                    <h3>{{$session->name}}</h3>
                                    <p class="det-session-text">{{ Str::limit( strip_tags($session->description) , 300 ) }}</p>
                                    <div class="det-session">
                                        <label>تاريخ الجلسة: </label>
                                        <span>{{$session->date_time->format('Y-m-d')}}</span>
                                    </div>
                                    <div class="det-session">
                                        <label>الساعة: </label>
                                        <span>{{$session->interval_time}}</span>
                                    </div>
{{--                                    <div class="det-session">--}}
{{--                                        <label>تبدأ الجلسة: </label>--}}
{{--                                        <span>{{$session->date_time->format('H:i')}}</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="det-session">--}}
{{--                                        <label>تنتهي الجلسة: </label>--}}
{{--                                        <span>{{$session->date_time_end->format('H:i')}}</span>--}}
{{--                                    </div>--}}

                                    @if($session->session_type == 3 || $session->session_type == 4)
                                        <div class="det-session">
                                            <label>طريقة التواصل: </label>
                                            <span>حضوري</span>
                                        </div>

                                        @if($select->address)
                                            <div class="det-session">
                                                <label>العنوان: </label>
                                                <span>{{$select->address}}</span>
                                            </div>
                                        @endif
                                        <div class="det-session">
                                            <label>العنوان على الخريطة: </label>
                                            <div class="gmap_canvas">
                                                <div id="map_canvas" class="maps" style="width:50%; height:200px;"></div>
                                            </div>                                        </div>
                                    @else
                                        <div class="det-session">
                                            <label>طريقة التواصل: </label>
                                            <span>{{$select->contact_by}}</span>
                                        </div>
                                    @endif

                                </td>
                                <td data-title="السعر" class="numeric price"><span
                                        class="font-def">{!! $session->price ? intval($session->price) ."<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>ا" !!}</span>
                                </td>
                            </tr>

                            <tr>
                                <td data-title="السعر الإجمالي" class="numeric label">
                                    السعر الإجمالي
                                </td>
                                <td data-title="السعر الإجمالي" class="numeric total"><span
                                        class="font-def">{!! $session->price ? intval($session->price) ."<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-lg-7">

                    <form class="invoice" method="post" action="{{route('site::profile')}}">

                        {{csrf_field()}}

                        <h3>معلومات الفاتورة</h3>

                        <div class="form-row">

                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="الإسم الأول" name="firstname"
                                           value="{{auth()->user()->firstname}}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="الإسم الأخير" name="lastname"
                                           value="{{auth()->user()->lastname}}">
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="البريد الإلكتروني"
                                           name="email" value="{{auth()->user()->email}}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="phone" class="form-control" placeholder="رقم الهاتف" name="mobile"
                                           value="{{auth()->user()->mobile}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-map"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="اسم الشارع" name="street"
                                           value="{{auth()->user()->street}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="المدينة">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-signs"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="رمز المنطقة" name="post_code"
                                           value="{{auth()->user()->post_code}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="الدولة" name="country"
                                           value="{{auth()->user()->country}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="المدينة" name="city"
                                           value="{{auth()->user()->city}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <button type="text" class="complete">حفظ البيانات</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

                <div class="col-lg-5">

                    <div class="payment">

                        <h3>الدفع</h3>

                        {{--                        <div class="type-pay">--}}

                        {{--                            <div class="form-row">--}}
                        {{--                                <div class="col">--}}
                        {{--                                    <label>--}}
                        {{--                                        <img src="{{url('mashael')}}/images/mastercard.png">--}}
                        {{--                                        <input type="radio">--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col">--}}
                        {{--                                    <label>--}}
                        {{--                                        <img src="{{url('mashael')}}/images/visa.png">--}}
                        {{--                                        <input type="radio">--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col">--}}
                        {{--                                    <label>--}}
                        {{--                                        <img src="{{url('mashael')}}/images/amex.png">--}}
                        {{--                                        <input type="radio">--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                        {{--                        </div>--}}

                        {{--                        <div class="form-row">--}}
                        {{--                            <div class="col">--}}
                        {{--                                <div class="input-group">--}}
                        {{--                                    <div class="input-group-prepend">--}}
                        {{--                                        <span class="input-group-text"><i class="far fa-credit-card"></i></span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <input type="text" class="form-control" placeholder="رقم البطاقة">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-row">--}}
                        {{--                            <div class="col">--}}
                        {{--                                <div class="input-group">--}}
                        {{--                                    <div class="input-group-prepend">--}}
                        {{--                                        <span class="input-group-text"><i class="far fa-calendar-check"></i></span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <input type="date" class="form-control" placeholder="MM    /    YYYY">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col">--}}
                        {{--                                <div class="input-group">--}}
                        {{--                                    <div class="input-group-prepend">--}}
                        {{--                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <input type="text" class="form-control" placeholder="رمز الأمان">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-row">--}}
                        {{--                            <div class="col">--}}
                        {{--                                <div class="input-group">--}}
                        {{--                                    <div class="input-group-prepend">--}}
                        {{--                                        <span class="input-group-text"><i class="fas fa-user"></i></span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <input type="text" class="form-control" placeholder="اسم صاحب البطاقة">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <p>من خلال الاستمرار في إجراء الطلب لدينا فأنت توافق على <a target="_blank"
                                                                                    href="{{route('site::page','terms')}}">الشروط
                                والأحكام</a></p>

                        {{--                        <button class="complete" data-toggle="modal" data-target="#complete-payment"><i class="fas fa-lock"></i> اتمام عملية الشراء</button>--}}

                        {{--                        <form method="post" action="{{route('site::course_order',$session->id)}}">--}}
                        {{--                            {{csrf_field()}}--}}
                        {{--                            <button type="submit" class="complete">--}}
                        {{--                                {{__('Subscribe now')}} ({{$session->price}}$)--}}
                        {{--                            </button>--}}
                        {{--                        </form>--}}

                        <button type="submit" id="payNow" class="complete">{{__('Subscribe now')}}
                            ({{intval($session->price)}})
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection


@section('footer')

    <script src="https://www.paytabs.com/express/v4/paytabs-express-checkout.js"
            id="paytabs-express-checkout"
            data-secret-key="v6i1EtAP3vADQDqFHMHptJvmMRIZes3KzmLdQm3USDxIgXnYK4odOTzBLiBZKFKk1vxRSALKejtvhRu1WSfLMOnx7YxSEhcFNKxG"
            data-merchant-id="10049104"
            data-url-redirect="{{route('site::callback')}}?date={{request('date')}}"
            data-amount="{{intval($session->price)}}"
            data-currency="SAR"
            data-title="{{$session->name}} ( {{auth()->user()->firstname}} {{auth()->user()->lastname}} ) "
            data-product-names="{{$session->name}}"
            data-order-id="session-{{$session->id}}-{{auth()->user()->id}}"
            data-customer-phone-number="{{auth()->user()->mobile}}"
            data-customer-email-address="{{auth()->user()->email}}"
            data-customer-country-code="{{auth()->user()->country_code}}"
    >
    </script>

    <style>
        a.PT_open_iframe {
            display: none !important;
        }
    </style>

    <script>
        $('#payNow').click(function () {
            Paytabs.openPaymentPage();
            return false;
        })
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=ar"></script>
    <script type="text/javascript">
        function initialize() {
            var stockholm = new google.maps.LatLng{{$session->coordinates}};
            var parliament = new google.maps.LatLng{{$session->coordinates}};
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

