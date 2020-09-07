@extends('site.layouts.app')

@section('title',$course->name)

@section('content')

    <div class="page-breadcrumb breadcrumb-courses-sn">

        <div class="container">

            <div class="breadcrumb-center d-table">

                <h3>الدورات</h3>

                <nav>
                    <ol class="breadcrumb">
                       <!--  <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li> -->
                        <li class="breadcrumb-item"><a href="{{route('site::courses')}}">الدورات</a></li>
                        <li class="breadcrumb-item active">{{$course->name}}</li>
                    </ol>
                </nav>

            </div>

        </div>

    </div>

    <section class="page-course-show">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="details-course">

                        <h3>{{$course->name}}</h3>

                        <div class="row">

                            <div class="col-lg-8">

                                <div class="block-details">
                                    <label>تقييم الدورة</label>
                                    <fieldset class="rating">
                                        <span
                                            class="fa fa-star {{ ($course->rates->count() > 0 and 5 > $course->rates->sum('rate')/$course->rates->count() and  $course->rates->sum('rate')/$course->rates->count() > 0) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($course->rates->count() > 0 and 5 > $course->rates->sum('rate')/$course->rates->count() and  $course->rates->sum('rate')/$course->rates->count() > 1) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($course->rates->count() > 0 and 5 > $course->rates->sum('rate')/$course->rates->count() and  $course->rates->sum('rate')/$course->rates->count() > 2) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($course->rates->count() > 0 and 5 > $course->rates->sum('rate')/$course->rates->count() and  $course->rates->sum('rate')/$course->rates->count() > 3) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($course->rates->count() > 0 and 5 > $course->rates->sum('rate')/$course->rates->count() and  $course->rates->sum('rate')/$course->rates->count() > 4) ? "checked" :"" }}"></span>
                                    </fieldset>
                                    <span class="rev">({{$course->rates->count()}} REVIEWS)</span>

                                </div>
                                <div class="block-details">
                                    <label>القسم</label>
                                    <span>{{ implode(",",$course->categories->pluck('name')->toArray()) }}</span>
                                </div>
                                <div class="block-details">
                                    <label>نوع الدورة</label>
                                    <span>{{$course->type ? $course->type->name : "غير محدد"}}</span>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="join-course">
                                    <span>{!! $course->price > 0 ? intval($course->price) . " <span class='font-def'>ريال</span>" : " <span class='font-def'>مجانا</span>" !!}</span>
                                    @if($course->type_id == 3)
                                        <a href="#" class="disabled">قريبا</a>
                                    @elseif(auth()->check() and in_array($course->id,auth()->user()->courses->pluck('id')->toArray()))
                                        <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                            مشترك
                                        </a>
                                    @elseif($course->type_id == 2)
                                        <a href="#" class="disabled">انتهى التسجيل</a>
                                    @else
                                        @if($course->persons != 0 and $course->persons <= $course->orders->count())
                                            <a href="#" class="disabled">انتهى التسجيل</a>
                                        @else
                                            <a href="{{route('site::course_order',$course->id)}}">الإشتراك
                                                بالدورة</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="thumb-course">
                            <img src="{{url('storage/app/'.$course->image)}}">
                            <span><i>{{$course->date_time->format('d')}}</i> {{months($course->date_time->format('m'))}} {{$course->date_time->format('Y')}}</span>
                        </div>

                        <div class="row">

                            <div class="offset-lg-8 col-lg-4">
                                <div class="join-course">
                                    <span>{!! $course->price > 0 ? intval($course->price) . " <span class='font-def'>ريال</span>" : " <span class='font-def'>مجانا</span>" !!}</span>
                                    @if($course->type_id == 3)
                                        <a href="#" class="disabled">قريبا</a>
                                    @elseif(auth()->check() and in_array($course->id,auth()->user()->courses->pluck('id')->toArray()))
                                        <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                            مشترك
                                        </a>
                                    @elseif($course->type_id == 2)
                                        <a href="#" class="disabled">انتهى التسجيل</a>
                                    @else
                                        @if($course->persons != 0 and $course->persons <= $course->orders->count())
                                            <a href="#" class="disabled">انتهى التسجيل</a>
                                        @else
                                            <a href="{{route('site::course_order',$course->id)}}">الإشتراك
                                                بالدورة</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="tabs-course">

                        <a href="{{route('site::course',$course->id)}}" class="active"><i class="fas fa-desktop"></i>
                            نظرة عامة</a>
                        <a href="{{ ( $course->lessons->count() > 0 ) ? route('site::lesson',$course->lessons->first()->id) : "#"}}"><i
                                class="fas fa-box-open"></i> محتوى الدورة</a>
                        <a href="{{ $course->trainer ? route('site::trainer',$course->trainer->id) : "#"}}"><i
                                class="fas fa-user"></i> نبذه عني</a>
                        <a href="{{route('site::comment',$course->id)}}"><i class="fas fa-chart-line"></i> التقييم
                            والتعليقات</a>

                    </div>

                    <div class="row">

                        <div class="col-lg-8">

                            <div class="description">
                                @if($course->intro_image)

                                    <img class="intro_image" src="{{$course->intro_image}}">

                                @endif

                            @if($course->intro)
                                    <h3 class="title-side">فيديو تعريفي</h3>
                                    @if(strpos($course->intro, 'facebook') !== false)
                                        <iframe width="100%" height="615"
                                                src="https://www.facebook.com/v2.3/plugins/video.php?allowfullscreen=true&autoplay=true&container_width=800&locale=en_US&sdk=joey&href={{$course->intro}}"
                                                frameborder="0"></iframe>
                                    @endif
                                    @if(strpos($course->intro, 'youtube') !== false)
                                        <iframe width="100%" height="615"
                                                src="{{str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$course->intro)}}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    @endif
                                    @if(strpos($course->intro, 'vimeo') !== false)
                                        <iframe
                                            src="{{str_replace("https://vimeo.com/","https://player.vimeo.com/video/",$course->intro)}}"
                                            width="100%" height="615" frameborder="0" allow="autoplay; fullscreen"
                                            allowfullscreen></iframe>
                                    @endif
                                    @if(strpos($course->intro, '/storage/lessons/') !== false)
                                        <video width="100%" height="615" controls>
                                            <source src="{{$course->intro}}" type="video/mp4">
                                            {{__('Your browser does not support HTML5 video')}}
                                        </video>
                                    @endif
                                @endif

                                {!! $course->description !!}
                            </div>

                        </div>


                        <div class="col-lg-4 line">

                            <div class="time-date">
                                <h3 class="title-side">الوقت والتاريخ</h3>
                                <span><i
                                        class="far fa-clock"></i> {{$course->date_time->format("H:i") }} {{period($course->date_time->format("A"))}}</span>
                                <span><i
                                        class="far fa-calendar-alt"></i> {{$course->date_time->format("d")}}  {{months($course->date_time->format('m'))}}  {{$course->date_time->format('Y')}}</span>
                            </div>

{{--                            <div class="course-map">--}}

{{--                                <h3 class="title-side">مكان الدورة</h3>--}}

{{--                                <div class="course-place">--}}
{{--                                    <div id="map_canvas" class="maps" style="width:100%; height:350px;"></div>--}}
{{--                                </div>--}}

{{--                                <h4><i class="fas fa-map-marker-alt"></i>{{$course->address}}</h4>--}}

{{--                            </div>--}}

                            <div class="time-date contact-info">

                                <h3 class="title-side">للتواصل والإستفسارات</h3>
                                <span><i class="fas fa-phone"></i> {{$course->trainer ? $course->trainer->mobile : "غير محدد"}}</span>
                                <span><i class="far fa-envelope"></i> {{$course->trainer ? $course->trainer->email : "غير محدد"}}</span>


                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="share-course">

                        <h3>مشاركة</h3>

                        <ul>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('site::course',$course->id)}}"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?url={{route('site::course',$course->id)}}&text={{$course->name}}"><i
                                        class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('site::course',$course->id)}}"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li>
                                <a href="whatsapp://send?text={{route('site::course',$course->id)}} {{$course->name}}"><i
                                        class="fab fa-whatsapp"></i></a>
                            </li>
                        </ul>

                    </div>

                </div>

            </div>

        </div>

        <div class="related">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="other-course">

                            <h3>دورات قد تهمك</h3>

                            <div class="slider-other-course all-courses owl-carousel slider-certificate">

                                @foreach(\App\Course::limit(5)->orderBy('id','DESC')->get() as $course)

                                    <div class="card">
                                        <a href="{{route('site::course',$course->id)}}" class="thumb-link">
                                            <img src="{{url('storage/app')}}/{{$course->image}}" class="card-img-top">
                                            <i>معرفة المزيد</i>
                                        </a>
                                        @if($course->free)
                                            <span class="price free">مجاناً</span>
                                        @else
                                            <span
                                                class="price">{!! $course->price ? intval($course->price) ." <span class='font-def'>ريال</span>" : " <span class='font-def'>مجانا</span>" !!}</span>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{$course->name}}</h5>
                                            <p class="card-text">{{ Str::limit( strip_tags($course->description) , 200 ) }}</p>
                                            <span class="star"> {{ ($course->rates->count() > 0 and 5 > $course->rates->sum('rate')/$course->rates->count() and  $course->rates->sum('rate')/$course->rates->count() > 0) ?  number_format($course->rates->sum('rate')/$course->rates->count(), 2, ',', ' ') :"0.0" }} <i
                                                    class="fas fa-star"></i></span>
                                            <span> {{$course->users->count()}} <i class="fas fa-user"></i></span>
                                            @if( !auth()->check() or !in_array($course->id,auth()->user()->courses->pluck('course_id')->toArray()))
                                                <a class="btn" href="{{route('site::course_order',$course->id)}}">الإشتراك
                                                    بالدورة</a>
                                            @else
                                                <a class="btn disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                                    مشترك </a>
                                            @endif

                                        </div>
                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


@endsection

@section('footer')

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=ar"></script>

    <script>
        function initialize() {

            var stockholm = new google.maps.LatLng{{$course->coordinates}};
            var parliament = new google.maps.LatLng{{$course->coordinates}};
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
