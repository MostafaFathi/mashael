@extends('site.layouts.app')

@section('title' , $workshop->name  )

@section('content')

    <div class="page-breadcrumb breadcrumb-courses">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>الإشتراك بورشة العمل</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::workshops')}}">ورش العمل</a></li>
                        <li class="breadcrumb-item active">الإشتراك بورشة العمل</li>
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
                        <div class="form-group row">
                            <label class="col-md-2">عدد الاشخاص</label>
                            <div class="col-md-2">

                                <select name="persons" id="persons" class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <div class="alert alert-info">السعر لشخص واحد ({{$workshop->price}} ريال) السعر لأكثر من شخص ({{$workshop->price2}} ريال)</div>
                            </div>
                        </div>
                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                            <thead class="head">
                            <tr>
                                <th class="numeric">ورشة العمل المسجلة</th>
                                <th class="numeric">السعر</th>
                            </tr>
                            </thead>
                            <tbody class="body-table">

                            <tr class="onePerson">
                                <td data-title="ورشة العمل المسجلة" class="numeric">
                                    <img src="{{url('mashael')}}/images/pay.png">
                                    <h3>{{$workshop->name}}</h3>
                                    <p>{{ Str::limit( strip_tags($workshop->description) , 300 ) }}</p>
                                </td>
                                <td data-title="السعر" class="numeric price"><span
                                        class="font-def">{!! $workshop->price ? intval($workshop->price) ."<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                                </td>
                            </tr>

                            <tr class="morePersons" style="display: none;">
                                <td data-title="ورشة العمل المسجلة" class="numeric">
                                    <img src="{{url('mashael')}}/images/pay.png">
                                    <h3>{{$workshop->name}}</h3>
                                    <p>{{ Str::limit( strip_tags($workshop->description) , 300 ) }}</p>
                                </td>
                                <td data-title="السعر" class="numeric price"><span
                                        class="font-def">{!! $workshop->price2 ? intval($workshop->price2) ."<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                                </td>
                            </tr>

                            <tr>
                                <td data-title="السعر الإجمالي" class="numeric label">
                                    السعر الإجمالي
                                </td>
                                <td data-title="السعر الإجمالي" class="numeric total"><span
                                        class="font-def priceTotal">{!! $workshop->price ? intval($workshop->price) ."<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
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
                                    <input type="text" class="form-control" placeholder="العنوان" name="address"
                                           value="{{auth()->user()->address}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="المدينة"
                                           value="{{auth()->user()->city}}">
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
                        <p>من خلال الاستمرار في إجراء الطلب لدينا فأنت توافق على <a target="_blank"
                                                                                    href="{{route('site::page','terms')}}">الشروط
                                والأحكام</a></p>

                        @if($workshop->price > 0)
                            <button type="submit" id="payNow" class="complete">{{__('Subscribe now')}}
                                (<span class="priceTotal">{{intval($workshop->price)}}</span>)
                            </button>
                        @else
                            <form method="post" action="{{route('site::workshop_order',$workshop->id)}}">
                                {{csrf_field()}}
                                <button type="submit" class="complete">
                                    {{__('Subscribe now')}} ( {{ __('free') }} )
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection


@section('footer')
    <style>
        a.PT_open_iframe {
            display: none !important;
        }
    </style>

    <script src="https://paytabs.com/express/v4/paytabs-express-checkout.js"></script>
    <script type="text/javascript">
        var Config = {
            settings: {
                secret_key: "v6i1EtAP3vADQDqFHMHptJvmMRIZes3KzmLdQm3USDxIgXnYK4odOTzBLiBZKFKk1vxRSALKejtvhRu1WSfLMOnx7YxSEhcFNKxG",
                merchant_id: "10049104",
                url_redirect: "{{route('site::callback')}}",
                amount: "{{intval($workshop->price)}}",
                title: "{{$workshop->name}} ( {{auth()->user()->firstname}} {{auth()->user()->lastname}} ) ",
                currency: "SAR",
                product_names: "{{$workshop->name}}",
                order_id: "workshop-{{$workshop->id}}-{{auth()->user()->id}}",
                ui_type: "iframe",
                is_popup: "true",
                ui_show_header: "true"
            },
            customer_info: {
                first_name: "{{auth()->user()->firstname}}",
                last_name: "{{auth()->user()->lastname}}",
                phone_number: "{{auth()->user()->mobile}}",
                email_address: "{{auth()->user()->email}}",
                card_street: "<?php echo e(auth()->user()->city); ?>",
                country_code: "966"
            }
            // ,billing_address: {
            //     full_address: "Business Bay",
            //     city: "Juffair",
            //     state: "Manama",
            //     country: "BHR",
            //     postal_code: "12345"
            // }
        }

        $('body').on('click','#payNow',function () {
            Paytabs.initWithIframe(document.body,Config);
            return false;
        })


        $('body').on('change', '#persons', function () {
            if ($(this).val() == 1) {
                $('.morePersons').hide();
                $('.onePerson').show();
                var price = $(this).val() *{{$workshop->price}};
                $(".priceTotal").text(price + "ريال")
                $('#paytabs-express-checkout').attr('data-amount', price)

            } else {
                $('.onePerson').hide();
                $('.morePersons').show();
                var price = $(this).val() *{{$workshop->price2}};
                $(".priceTotal").text(price + "ريال")
                $('#paytabs-express-checkout').attr('data-amount', price)

            }

            Config.settings.amount = price;


        })
    </script>

@endsection

