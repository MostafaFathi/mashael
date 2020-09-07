@extends('site.layouts.app')

@section('title',__('Home'))
@section('content')

    <section class="intro">

        <div class="container">

            <div class="intro-word">

                <h3>{!! $pages['intro']->description !!}</h3>

                <form class="add_email" method="post" action="{{route('site::addEmail')}}">
                    {{csrf_field()}}
                    <h4>سجل معنا ليصلك كل جديدنا</h4>

                    <div class="form-group">
                        <input name="email" class="form-control" placeholder="اكتب بريدك الإلكتروني هنا">
                        <button class="btn" type="submit">اشتراك</button>
                        <div class="addEmailArea"></div>
                    </div>

                </form>

            </div>

        </div>

    </section>

    <section class="page-courses">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="slider-courses owl-carousel">

                        @foreach(\App\Workshop::where('slider',1)->orderBy('id','DESC')->get() as $workshop)

                            <div class="item">

                                <img src="{{url('storage/app')}}/{{$workshop->sliderImage}}">

                                <div class="info-course">

                                    <div class="time" id="timer-w-{{$workshop->id}}">


                                    </div>

                                    <h3>{{$workshop->name}}</h3>

                                    <div class="address">

                                        <span><i class="fas fa-map-marker-alt"></i> {{$workshop->address}}</span>
                                        <span><i
                                                class="far fa-calendar-alt"></i>{{$workshop->date_time->format('d')}} {{months($workshop->date_time->format('m'))}} {{$workshop->date_time->format('Y')}}</span>
                                        <span><i
                                                class="far fa-clock"></i>{{$workshop->date_time->format('H:i') }} {{period($workshop->date_time->format("A"))}}</span>

                                    </div>

                                </div>

                                <a href="{{route('site::workshop',$workshop->id)}}" class="stretched-link"></a>

                            </div>

                        @section('footer')


                            <script>
                                $(document).ready(function () {


                                    // Set the date we're counting down to
                                        {{--var countDownDate = new Date("{{$workshop->date_time->format('Nov 29, 2019 15:37:25')}}").getTime();--}}
                                    var countDownDate = new Date("{{$workshop->date_time->format('M d, Y H:i:s')}}").getTime();

                                    // Update the count down every 1 second
                                    var x = setInterval(function () {

                                        // Get today's date and time
                                        var now = new Date().getTime();

                                        // Find the distance between now and the count down date
                                        var distance = countDownDate - now;

                                        // Time calculations for days, hours, minutes and seconds
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        // Output the result in an element with id="demo"
                                        document.getElementById("timer-w-{{$workshop->id}}").innerHTML = "<span><i>" + days + "</i>يوم</span><span><i>" + hours + "</i>ساعة</span><span><i>"
                                            + minutes + "</i>دقيقة</span><span><i>" + seconds + "</i>ثانية</span>";

                                        // If the count down is over, write some text
                                        if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("timer-w-{{$workshop->id}}").innerHTML = "<span class=\"end\">انتهى الوقت</span>";
                                        }
                                    }, 1000);
                                })
                            </script>



                        @endsection

                    @endforeach

                        @foreach(\App\Course::where('slider',1)->orderBy('id','DESC')->get() as $course)

                            <div class="item">

                                <img src="{{url('storage/app')}}/{{$course->sliderImage}}">

                                <div class="info-course">

                                    <div class="time" id="timer-c-{{$course->id}}">


                                    </div>

                                    <h3>{{$course->name}}</h3>

                                    <div class="address">

                                        <span><i class="fas fa-map-marker-alt"></i> {{$course->address}}</span>
                                        <span><i
                                                class="far fa-calendar-alt"></i>{{$course->date_time->format('d')}} {{months($course->date_time->format('m'))}} {{$course->date_time->format('Y')}}</span>
                                        <span><i
                                                class="far fa-clock"></i>{{$course->date_time->format('H:i') }} {{period($course->date_time->format("A"))}}</span>

                                    </div>

                                </div>

                                <a href="{{route('site::course',$course->id)}}" class="stretched-link"></a>

                            </div>

                        @section('footer')


                            <script>
                                $(document).ready(function () {


                                    // Set the date we're counting down to
                                        {{--var countDownDate = new Date("{{$course->date_time->format('Nov 29, 2019 15:37:25')}}").getTime();--}}
                                    var countDownDate = new Date("{{$course->date_time->format('M d, Y H:i:s')}}").getTime();

                                    // Update the count down every 1 second
                                    var x = setInterval(function () {

                                        // Get today's date and time
                                        var now = new Date().getTime();

                                        // Find the distance between now and the count down date
                                        var distance = countDownDate - now;

                                        // Time calculations for days, hours, minutes and seconds
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        // Output the result in an element with id="demo"
                                        document.getElementById("timer-c-{{$course->id}}").innerHTML = "<span><i>" + days + "</i>يوم</span><span><i>" + hours + "</i>ساعة</span><span><i>"
                                            + minutes + "</i>دقيقة</span><span><i>" + seconds + "</i>ثانية</span>";

                                        // If the count down is over, write some text
                                        if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("timer-c-{{$course->id}}").innerHTML = "<span class=\"end\">انتهى الوقت</span>";
                                        }
                                    }, 1000);
                                })
                            </script>


                        @endsection

                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </section>
{{--    <section class="know-more">--}}

{{--        <div class="container">--}}

{{--            <h2>اعرف المزيد عن الذي نقدمه</h2>--}}

{{--            <h5>الحلول والتخطيط المثالي لمن يريد الوصول لأهدافه</h5>--}}

{{--            <div class="row">--}}
{{--                --}}
{{--                <div class="col-lg-4">--}}

{{--                    <div class="item-more">--}}

{{--                        <img src="{{url('storage/app')}}/{{$pages['views']->image}}">--}}

{{--                        <h3>{{$pages['views']->name}}</h3>--}}

{{--                        <p>{!!$pages['views']->description!!}</p>--}}

{{--                        <a href="{{$pages['views']->url}}">استكشف المزيد</a>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="col-lg-4">--}}

{{--                    <div class="item-more">--}}

{{--                        <img src="{{url('storage/app')}}/{{$pages['workshop']->image}}">--}}

{{--                        <h3>{{$pages['workshop']->name}}</h3>--}}

{{--                        <p>{!!$pages['workshop']->description!!}</p>--}}

{{--                        <a href="{{$pages['workshop']->url}}">استكشف المزيد</a>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="col-lg-4">--}}

{{--                    <div class="item-more">--}}

{{--                            <img src="{{url('storage/app')}}/{{$pages['courses']->image}}">--}}

{{--                        <h3>{{$pages['courses']->name}}</h3>--}}

{{--                        <p>{!!$pages['courses']->description!!}</p>--}}

{{--                        <a href="{{$pages['courses']->url}}">استكشف المزيد</a>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </section>--}}

    <section class="about-us page-about">

        <div class="container">

            <div class="row ch-dir">

                <div class="col-lg-5 col-md-6 col-sm-12">

                    <div class="thumb-about">
                        <img src="{{url('storage/app')}}/{{$pages['about']->image}}">
                    </div>

                </div>

                <div class="col-lg-7 col-md-6">

                    <div class="word-about word-about-us ml-5 clearfix">
                        <div class="titles clearfix">
                            <h5 class="d-table">أهلاً بكم جميعاً</h5>

                            <h3 class="d-table">أنا المدربة مشاعل العقيّل</h3>

                            <h6 class="d-table">مدربة وعي وتطوير ذات</h6>
                        </div>

                        <p>{!! $pages['about']->description !!}</p>

                        <div class="whats">
                            <span>للاستفسار عن طريق الواتساب على الرقم (<span
                                    class="num">{{\App\Setting::getValue('whatsapp')}}</span>)</span>
                        </div>

                        <span class="r-more">للاطلاع على الدورات والحجز <a
                                href="{{route('site::courses')}}">جميع الدورات</a>
                            </span>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <div class="counter-back">

        <section class="container">

            <div class="counter">

                <div class="row">

                    <div class="col-lg-3 col-sm-3 col-6">

                        <div class="item-counter">
                            <span>{{\App\Setting::getValue('Years_of_experience')}}</span>
                            <h3>سنة خبرة</h3>
                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-3 col-6">

                        <div class="item-counter">
                            <span>{{\App\Setting::getValue('Training_course')}}</span>
                            <h3>دورة تدريبية</h3>
                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-3 col-6">

                        <div class="item-counter">
                            <span>{{\App\Setting::getValue('Workshop')}}</span>
                            <h3>ورشة عمل</h3>
                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-3 col-6">

                        <div class="item-counter">
                            <span>{{\App\Setting::getValue('Book_and_article')}}</span>
                            <h3>كتاب ومقالة</h3>
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>
    <section class="courses">

        <h3>الدورات و ورش العمل</h3>
        <h5>اطلع على جميع الدورات و ورش العمل وبادر بالحجز بالدورة المناسبة لك</h5>

        <div class="slider-courses owl-carousel" id="slider-courses">

            @foreach(\App\Course::limit(5)->orderBy('id','DESC')->get() as $course)
                <div class="item">

                    <img src="{{url('storage/app')}}/{{$course->image}}">

                    @if($course->price > 0)
                        <span
                            class="price">{!! $course->price ? intval($course->price) ."<span class='font-def'> ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                    @else
                        <span class="price free">مجاناً</span>
                    @endif
                    <div class="info">

                        <span>{{months($course->date_time->format('m'))}} {{$course->date_time->format('d Y')}}</span>

                        <h3>{{$course->name}}</h3>

                    </div>

                    <a href="{{route('site::course',$course->id)}}" class="stretched-link"></a>

                </div>
            @endforeach
        </div>

    </section>
    <section class="workshop" id="create_session">

        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-6">

                    <h2>ورش العمل</h2>

                    <div class="thumbnails-work owl-carousel" id="workshop-slider">

                        @foreach(\App\Workshop::limit(5)->orderBy('id','DESC')->get() as $workshop)

                            <div class="item event-{{$workshop->id}}">

                                <img src="{{url('storage/app')}}/{{$workshop->image}}">

                                <div class="info">

                                    <h3>{{$workshop->name}}</h3>

                                    <span><i class="fas fa-map-marker-alt"></i>{{$workshop->address}}</span>

                                    <span><i
                                            class="fas fa-clock"></i>{{$workshop->date_time->format("H:i")}} {{period( $workshop->date_time->format("A"))}}</span>

                                </div>

                                <span class="date"><i>{{$workshop->date_time->format("d")}}</i>{{months( $workshop->date_time->format("m"))}}</span>

                                <a href="{{route('site::workshop',$workshop->id)}}" class="stretched-link"></a>

                            </div>

                        @endforeach

                    </div>

                </div>

                <div class="offset-lg-1 col-lg-5 col-sm-6">
                    <h2>حجز جلسة </h2>

                    <div class="calendar">
                        <div id="datepicker" class="datepicker" data-date="{{date('m/d/Y')}}"></div>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <section class="clients-opinion">

        <div class="container">

            <h3>آراء العملاء</h3>
            <h5>تهمنا آراؤكم ومشاركاتكم ونسعى لتقديم ما هو أفضل لاسعادكم</h5>

            <div class="slider-clients owl-carousel" id="slider-clients">

                @foreach(\App\Testimonial::orderBy('id','DESC')->get() as $testimonial)
                    <div class="item">
                        <img src="{{url('storage/app')}}/{{$testimonial->image}}">
                        <p>{{$testimonial->description}}</p>
                        <h4>{{$testimonial->name}}<span>{{$testimonial->birthday}}</span></h4>
                    </div>
                @endforeach

            </div>

        </div>

    </section>
    <section class="partners">

        <div class="container">

            <div class="slider-partners owl-carousel" id="slider-partners">

                @foreach(\App\Partner::orderBy('id','DESC')->get() as $partner)
                    <div class="item">
                        <a href="{{$partner->url}}" data-toggle="tooltip" data-placement="top"
                           title="{{$partner->name}}"><img
                                src="{{url('storage/app')}}/{{$partner->image}}"></a>
                    </div>
                @endforeach

            </div>

        </div>

    </section>

@endsection
