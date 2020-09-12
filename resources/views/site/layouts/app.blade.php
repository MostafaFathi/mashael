<!doctype html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Setting::getValue('name') }} - @yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="{{url('mashael')}}/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('mashael')}}/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('mashael')}}/images/favicon-16x16.png">
    <link rel="manifest" href="{{url('mashael')}}/images/site.webmanifest">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('mashael')}}/css/bootstrap-rtl.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"
          integrity="sha256-JDBcnYeV19J14isGd3EtnsCQK05d8PczJ5+fvEvBJvI=" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
          integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">

    <link rel="stylesheet" href="{{url('mashael')}}/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    @yield('header')

</head>
<body>

<header class="header">

    <div class="container">

        <div class="search-form">

            <form class="form-group" action="{{route('site::search')}}">
                <a href="" class="close"><i class="fas fa-times-circle"></i></a>
                <input class="form-control" type="text" name="search" placeholder="بحث" value="{{request('search')}}">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>

        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{route('site::home')}}"><img
                    src="{{url('storage/app').'/'.\App\Setting::getValue('logo')}}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{url('mashael')}}/images/menu.svg">
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::home')}}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::trainer')}}">نبذة عني</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::courses')}}">الدورات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::profile.askMashael')}}"> اسأل مشاعل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::questions.common')}}"> الاسئلة الشائعة</a>
                    </li>
                    <li class="center-brand">
                        <a href="{{route('site::home')}}"><img
                                src="{{url('storage/app').'/'.\App\Setting::getValue('logo')}}"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::workshops')}}">ورش العمل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}#create_session">حجز الجلسات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site::contactus')}}">اتصل بنا</a>
                    </li>
                    @if(auth()->check())
                        <li class="nav-item register prof">
                            <a class="nav-link" href="{{route('site::profile')}}">أهلاً, {{auth()->user()->name}}</a>
                        </li>
                        <li class="nav-item register">
                            <a class="nav-link" href="{{route('site::logout')}}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل
                                الخروج</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('site::login')}}">تسجيل الدخول</a>
                        </li>
                        <li class="nav-item register">
                            <a class="nav-link" href="{{route('site::register')}}">سجل معنا</a>
                        </li>
                    @endif
                    <li class="nav-item search">
                        <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        المزيد
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach(config('allPages') as $page)
                            @if($page->location == 'Header')
                                <a class="dropdown-item" href="{{  url('/').'/page/'.$page->id }}">{{$page->name}}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </nav>

    </div>

</header>

@yield('content')

<footer class="footer">

    <div class="container">

        <div class="join-us">

            <div class="row">

                <div class="col-lg-12">

                    <h3>اشترك معنا ليصلك ما هو جديد</h3>
                    <p>عن ورش العمل والدورات </p>

                </div>

                <form class="join-form" method="post" action="{{route('site::addEmail')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input class="form-control" placeholder="اكتب بريدك الإلكتروني هنا">
                    </div>

                    <button class="btn" type="submit">اشتراك</button>

                </form>

            </div>

        </div>

        <div class="links-footer float-right">
            <ul>
                @foreach(config('allPages') as $page)
                    @if($page->location == 'Footer')
                        <li><a class="dropdown-item" href="{{  url('/').'/page/'.$page->id }}">{{$page->name}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="brand-footer">
            <a href="">
                <img src="{{url('mashael')}}/images/logofooter.png">
            </a>
        </div>

        <div class="social-links">
            <ul>
                <li>
                    <a href="{{\App\Setting::getValue('facebook')}}"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                    <a href="{{\App\Setting::getValue('twitter')}}"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                    <a href="{{\App\Setting::getValue('linkedin')}}"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li>
                    <a href="{{\App\Setting::getValue('youtube')}}"><i class="fab fa-youtube"></i></a>
                </li>
            </ul>
        </div>

        <div class="footer-links clearfix">

            <ul>
                <li><a href="{{route('site::page',10)}}">الشروط والأحكام</a></li>
                <li><a href="{{route('site::page',11)}}">سياسة الاسترجاع</a></li>
                <li><a href="{{route('site::page',12)}}">سياسة الخصوصية</a></li>
            </ul>

            <div class="clearfix"></div>

            <div class="card-pay">
                <img src="{{url('mashael')}}/images/visa.png">
                <img src="{{url('mashael')}}/images/mastercard.png">
            </div>


        </div>

    </div>

    <div class="copyright">

        <div class="container">

            <a href=""><img src="{{url('mashael')}}/images/up.svg"></a>

            <p>Copyright 2020 Corporate <span>Mashael Aloqiel</span></p>

        </div>

    </div>

</footer>

<form id="logout-form" action="{{ route('site::logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"
        integrity="sha256-tW5LzEC7QjhG0CiAvxlseMTs2qJS7u3DRPauDjFJ3zo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"
        integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>

<script type="text/javascript">

    $(window).scroll(function () {

        if ($(this).scrollTop() > 300) {

            $('.header').addClass('fixed');

        } else {

            $('.header').removeClass('fixed');

        }

    });

    @if(session('success'))
    swal(
        'نجاح العملية',
        '{{session("success")}}',
        'success'
    )
    @endif

    @if(session('status'))
    swal(
        'نجاح العملية',
        '{{session("status")}}',
        'success'
    )
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    swal(
        'فشل العملية',
        '{{$error}}',
        'error'
    )
    @endforeach
    @endif

    $('[data-toggle="tooltip"]').tooltip()

    $('.footer .copyright a').click(function () {
        $('html,body').animate({scrollTop: 0}, 'slow');
        return false;
    });

    $(".header .navbar-nav .search").click(function () {

        $(".header .search-form").addClass('show-search');

        return false;

    });

    $(".header .search-form .form-group .close").click(function () {

        $(".header .search-form").removeClass('show-search');

        return false;

    });


    $('#slider-courses').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        lazyLoad: true,
        smartSpeed: 1000,
        rtl: true,
        autoplay: false,
        navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
        dots: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            992: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });


    $('#workshop-slider').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        lazyLoad: true,
        rtl: true,
        smartSpeed: 1000,
        autoplay: false,
        navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('#slider-clients').owlCarousel({
        loop: true,
        margin: 40,
        nav: false,
        lazyLoad: true,
        smartSpeed: 1000,
        rtl: true,
        autoplay: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });

    $('#slider-partners').owlCarousel({
        loop: true,
        margin: 90,
        nav: false,
        smartSpeed: 1000,
        lazyLoad: true,
        rtl: true,
        autoplay: false,
        dots: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            992: {
                items: 5
            },
            1000: {
                items: 5
            }
        }
    });

    $('.slider-certificate').owlCarousel({
        loop: true,
        margin: 30,
        smartSpeed: 1000,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
        lazyLoad: true,
        rtl: true,
        autoplay: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            992: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });

    $('.slider-courses').owlCarousel({
        loop: false,
        margin: 30,
        nav: true,
        smartSpeed: 1000,
        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
        lazyLoad: true,
        rtl: true,
        autoplay: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            992: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });


    $(function () {

        var events = [
                @foreach(\App\Session::where('id','>',10)->wheredate('date_time','>=',date('Y-m-d'))->doesntHave('orders')->orderBy('id','DESC')->get() as $session)
            {
                ID: '{{$session->id}}',
                Title: "{{$session->name}}",
                Date: new Date("{{$session->date_time->format("m/d/Y")}}")
            },
            @endforeach
        ];

        $("#datepicker").datepicker({
            language: "ar",
            beforeShowDay: function (date) {
                var result = {};
                var matching = $.grep(events, function (event) {
                    return event.Date.valueOf() === date.valueOf();
                });

                if (matching.length) {
                    result = {
                        classes: 'activeDay',
                        tooltip: matching[0].ID,
                        //content:matching[0].Title
                    };
                }
                return result;
            }
        });

        $('.datepicker-days').on('click', '.day', function () {

            $('#OrderSession').modal('show');
            $('#OrderSession .modal-body').html("الرجاء الانتظار...");

            $.get("{{route('site::get_session')}}", {'date':$(this).attr('data-date'),'id': $(this).attr('title') ? $(this).attr('title') : 0}, function (data) {
                // if (data.length == 1) {
                //window.location.replace("{{url('session')}}/"+data[0].id +"/order");
                // } else {
                console.log(data);
                var html = ` `;

                if (data) {
                    if (data.length > 0) {
                        html += ' <div class="sessionsList"><h3>اختر جلسة</h3><ul >';
                        $.each(data, function (k, v) {
                            html += '<li><a href="{{url('session')}}/' + v.id + '/order?id=' + v.id + '&date=' + data.date + '"><i class="fas fa-clipboard-check"></i> ' +' الساعة ' +v.interval_time +': '+  v.session_type.name + ' </a></li>';
                        })
                        html += '</ul></div>';
                    } else {
                        html += ' <div class="alert alert-danger">لا يوجد جلسات لهذا اليوم</div>';
                    }
                } else {
                    html += ' <div class="alert alert-danger">لا يوجد جلسات لهذا اليوم<div>';
                }
                $('#OrderSession .modal-body').html(html);
                // }
            })
        })
    });

</script>

<!-- Modal -->
<div class="modal fade complete-payment" id="complete-payment" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <img src="{{url('mashael')}}/images/icon-comp.png">

                <h3>تهانينا !!</h3>

                <p>تمت عملية اشتراكك بالدورة بنجاح</p>

                <span>سيصلك بريد إلكتروني بمعلومات وتفاصيل الدورة</span>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade OrderSession" id="OrderSession" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <ul>
                    <li><a href="#">الجلسة الاولى</a></li>
                    <li><a href="#">الجلسة الاولى</a></li>
                    <li><a href="#">الجلسة الاولى</a></li>
                    <li><a href="#">الجلسة الاولى</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="DisableAccountModal" tabindex="-1" role="dialog" aria-labelledby="DisableAccountModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DisableAccountModalLabel">الحساب معطل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                حسابك معطل الرجاء مراجعة الادارة
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

@yield('footer')

<style id="compiled-css" type="text/css">
    .activeDay {
        background: #3a592a;
        color: #fff !important;
        border: 1px solid rgba(255, 59, 71, 0.7);
    }

</style>

<script>
    @if ($errors->has('disabledAccount'))
    @error('disabledAccount')
    $('#DisableAccountModal').modal('show')
    @enderror
    @endif
</script>
</body>
</html>
