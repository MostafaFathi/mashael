@extends('site.layouts.app')

@section('title',__('Workshops'))

@section('content')

    <div class="page-breadcrumb breadcrumb-contact">

        <div class="container">

            <div class="breadcrumb-center d-table">

            <h3>ورش العمل</h3>

                <nav>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">ورش العمل</li>
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

                        @foreach(\App\Workshop::where('slider',1)->orderBy('id','DESC')->get() as $workshop)

                            <div class="item">

                                <img src="{{url('storage/app')}}/{{$workshop->sliderImage}}">

                                <div class="info-course">

                                    <div class="time" id="timer-{{$workshop->id}}">


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

                        @endforeach

                    </div>

                </div>

            </div>


            <div class="all-courses">

                <div class="row">

                    @foreach($pages = \App\Workshop::orderBy('id','DESC')->paginate(9) as $workshop)


                        <div class="col-lg-4 col-md-4 col-sm-6">

                            <div class="card">
                                <img src="{{url('storage/app')}}/{{$workshop->image}}" class="card-img-top">
                                <span class="date"><i>{{$workshop->date_time->format('d')}}</i>{{months($workshop->date_time->format('m'))}} </span>
                                @if($workshop->type->id == 2)
                                    <span class="online"><img width="13"
                                                              src="{{url('storage/app')}}/{{$workshop->type ? $workshop->type->image : ""}}"><br>{{$workshop->type ? $workshop->type->name : ""}}</span>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$workshop->name}}</h5>
                                    <span class="time"><i
                                            class="far fa-clock"></i> {{$workshop->date_time->format('H:m')}} {{period($workshop->date_time->format("A"))}}</span>
                                    @if($workshop->address)
                                        <span class="time"><i
                                                class="fas fa-map-marker-alt"></i> {{$workshop->address}}</span>
                                    @endif
                                    <p class="card-text">{{ Str::limit( strip_tags($workshop->description) , 140 ) }}</p>
                                    <span class="price">@if($workshop->price > 0 ) {{intval($workshop->price)}} ريال @else
                                            مجانا @endif </span>
                                    @if(!auth()->check() or !in_array($workshop->id,auth()->user()->courses->pluck('id')->toArray()))
                                        <a class="btn" href="{{route('site::workshop',$workshop->id)}}">الإشتراك بورشة العمل</a>
                                    @else
                                        <a class="btn" href="{{route('site::workshop',$workshop->id)}}"><i
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

    @foreach(\App\Workshop::where('slider',1)->orderBy('id','DESC')->get() as $workshop)
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
                    document.getElementById("timer-{{$workshop->id}}").innerHTML = "<span><i>" + days + "</i>يوم</span><span><i>" + hours + "</i>ساعة</span><span><i>"
                        + minutes + "</i>دقيقة</span><span><i>" + seconds + "</i>ثانية</span>";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("timer-{{$workshop->id}}").innerHTML = "<span class=\"end\">انتهى الوقت</span>";
                    }
                }, 1000);
            })
        </script>

    @endforeach


@endsection
