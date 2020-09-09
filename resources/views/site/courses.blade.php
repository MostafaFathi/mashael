@extends('site.layouts.app')

@section('title',__('Courses'))

@section('content')

    <div class="page-breadcrumb breadcrumb-courses">

        <div class="container">

            <div class="breadcrumb-center d-table">

            <h3>الدورات</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الدورات</li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>

    <section class="page-courses">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="slider-courses owl-carousel">

                        @foreach(\App\Course::where('slider',1)->orderBy('id','DESC')->get() as $course)

                            <div class="item">

                                <img src="{{url('storage/app')}}/{{$course->sliderImage}}">

                                <div class="info-course">

                                    <div class="time" id="timer-{{$course->id}}">


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

                        @endforeach

                    </div>

                </div>

            </div>


            <div class="all-courses">

                <div class="row">

                    @foreach($pages = \App\Course::orderBy('id','DESC')->paginate(9) as $course)


                        <div class="col-lg-4 col-md-4 col-sm-6">

                            <div class="card">
                                <img src="{{url('storage/app')}}/{{$course->image}}" class="card-img-top">
                                <span class="date"><i>{{$course->date_time->format('d')}}</i>{{months($course->date_time->format('m'))}} </span>

                                <div class="card-body">
                                    <h5 class="card-title">{{$course->name}}</h5>
                                    <span class="time"><i
                                            class="far fa-clock"></i> {{$course->date_time->format('H:m')}} {{period($course->date_time->format("A"))}}</span>
                                    @if($course->address)
                                        <span class="time"><i
                                                class="fas fa-map-marker-alt"></i> {{$course->address}}</span>
                                    @endif
                                    <p class="card-text">{!! Str::limit( strip_tags($course->description) , 140 ) !!}</p>
                                    <span class="price">@if($course->price > 0 ) {{intval($course->price)}} ريال @else
                                            مجانا @endif </span>
                                    @if(!auth()->check() or !in_array($course->id,auth()->user()->courses->pluck('course_id')->toArray()))
                                        <a class="btn" href="{{route('site::course',$course->id)}}">الإشتراك بالدورة</a>
                                    @else
                                        <a class="btn" href="{{route('site::course',$course->id)}}"><i
                                                class="fas fa-check-circle"></i> أنت مشترك </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
                <div class="navigation">
                    {{$pages->links()}}
                </div>

            </div>

        </div>

    </section>

@endsection

@section('footer')

    @foreach(\App\Course::where('slider',1)->orderBy('id','DESC')->get() as $course)
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
                    document.getElementById("timer-{{$course->id}}").innerHTML = "<span><i>" + days + "</i>يوم</span><span><i>" + hours + "</i>ساعة</span><span><i>"
                        + minutes + "</i>دقيقة</span><span><i>" + seconds + "</i>ثانية</span>";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("timer-{{$course->id}}").innerHTML = "<span class=\"end\">انتهى الوقت</span>";
                    }
                }, 1000);
            })
        </script>

    @endforeach


@endsection
