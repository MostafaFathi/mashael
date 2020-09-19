@extends('site.layouts.app')

@section('title',$lesson->course->name)

@section('content')

    <div class="page-breadcrumb breadcrumb-courses">

        <div class="container">

            <h3>الدورات</h3>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{route('site::courses')}}">الدورات</a></li>
                    <li class="breadcrumb-item active">{{$lesson->course->name}}</li>
                </ol>
            </nav>

        </div>

    </div>

    <section class="page-course-show">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="details-course">

                        <h3>{{$lesson->course->name}}</h3>

                        <div class="row">

                            <div class="col-lg-8">

                                <div class="block-details">
                                    <label>تقييم الدورة</label>
                                    <fieldset class="rating">
                                        <span class="fa fa-star {{ ($lesson->course->rates->count() > 0 and 5 > $lesson->course->rates->sum('rate')/$lesson->course->rates->count() and  $lesson->course->rates->sum('rate')/$lesson->course->rates->count() > 0) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($lesson->course->rates->count() > 0 and 5 > $lesson->course->rates->sum('rate')/$lesson->course->rates->count() and  $lesson->course->rates->sum('rate')/$lesson->course->rates->count() > 1) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($lesson->course->rates->count() > 0 and 5 > $lesson->course->rates->sum('rate')/$lesson->course->rates->count() and  $lesson->course->rates->sum('rate')/$lesson->course->rates->count() > 2) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($lesson->course->rates->count() > 0 and 5 > $lesson->course->rates->sum('rate')/$lesson->course->rates->count() and  $lesson->course->rates->sum('rate')/$lesson->course->rates->count() > 3) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($lesson->course->rates->count() > 0 and 5 > $lesson->course->rates->sum('rate')/$lesson->course->rates->count() and  $lesson->course->rates->sum('rate')/$lesson->course->rates->count() > 4) ? "checked" :"" }}"></span>
                                    </fieldset>

                                    <span class="rev">({{$lesson->course->rates->count()}} REVIEWS)</span>

                                </div>
                                <div class="block-details">
                                    <label>القسم</label>
                                    <span>{{ implode(",",$lesson->course->categories->pluck('name')->toArray()) }}</span>
                                </div>
                                <div class="block-details">
                                    <label>نوع الدورة</label>
                                    <span>{{$lesson->course->type ? $lesson->course->type->name : "غير محدد"}}</span>
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="join-course">
                                    <span>{!! $lesson->course->price > 0 ? intval($lesson->course->price) . "<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                                    @if(!auth()->check() or !in_array($lesson->course->id,auth()->user()->courses->pluck('id')->toArray()))
                                        <a href="{{route('site::course_order',$lesson->course->id)}}">الإشتراك بالدورة</a>
                                    @else
                                        <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت مشترك </a>
                                    @endif
                                </div>

                            </div>

                        </div>


                        <div class="thumb-course">

                            @if(auth()->check())
                                @if($lesson->course->check || auth()->user()->email == 'mashael.aloqiel@gmail.com')
                                    @if($lesson->course->check->status == "approved"  || auth()->user()->email == 'mashael.aloqiel@gmail.com')
                                        @if(strpos($lesson->video_url, 'facebook') !== false)
                                            <iframe width="100%" height="615"
                                                    src="https://www.facebook.com/v2.3/plugins/video.php?allowfullscreen=true&autoplay=true&container_width=800&locale=en_US&sdk=joey&href={{$lesson->video_url}}"
                                                    frameborder="0"></iframe>
                                        @endif
                                        @if(strpos($lesson->video_url, 'youtube') !== false)
                                            <iframe width="100%" height="615"
                                                    src="{{str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$lesson->video_url)}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        @endif
                                        @if(strpos($lesson->video_url, 'vimeo') !== false)
                                            <iframe
                                                src="{{str_replace("https://vimeo.com/","https://player.vimeo.com/video/",$lesson->video_url)}}"
                                                width="100%" height="615" frameborder="0" allow="autoplay; fullscreen"
                                                allowfullscreen></iframe>
                                        @endif
                                        @if(strpos($lesson->video_url, '/storage/lessons/') !== false)
                                            <video width="100%" height="615" controls>
                                                <source src="{{$lesson->video_url}}" type="video/mp4">
                                                {{__('Your browser does not support HTML5 video')}}
                                            </video>
                                        @endif
                                    @else
                                        <div
                                            class="alert alert-danger">{{__('Application status and joining the course')}}
                                            <span
                                                class="badge badge-info">{{$lesson->course->check->status}}</span></div>
                                    @endif
                                @else
                                    <div class="alert alert-danger"> {{__('You are not subscribed to this course')}} <a
                                            href="{{route('site::course_order',$lesson->id)}}">{{__('Subscribe now')}}</a>
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-danger">{{__('You are not login')}} <a
                                        href="{{route('site::login')}}">{{__('Login')}}</a> , <a
                                        href="{{route('site::register')}}">{{__('Register')}}</a></div>
                            @endif

                        </div>


                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="tabs-course">

                        <a href="{{route('site::course',$lesson->course->id)}}"><i
                                class="fas fa-desktop"></i> نظرة عامة</a>
                        <a href="{{ $lesson->course->lessons ? route('site::lesson',$lesson->course->lessons->first()->id) : "#"}}"
                           class="active"><i
                                class="fas fa-box-open"></i> محتوى الدورة</a>
                        <a href="{{ $lesson->course->lessons ? route('site::trainer',$lesson->course->trainer->id) : "#"}}"><i
                                class="fas fa-user"></i> نبذه عني</a>
                        <a href="{{route('site::comment',$lesson->course->id)}}"><i
                                class="fas fa-chart-line"></i> التقييم والتعليقات</a>

                    </div>

                    <div class="row">

                        <div class="col-lg-8">


                            <div class="content-course">
                                @if($lesson->course->lessons->count() > 0)
                                    @php $i = 1; @endphp
                                    @foreach($lesson->course->lessons as $lessonList)

                                        <div class="video-course">

                                            @if($lessonList->id != $lesson->id)
                                                <i class="number">{{$i++}}</i>
                                            @else
                                                <i class="number fas fa-play-circle"><span style="display: none">{{$i++}}</span></i>
                                            @endif

                                            <img src="{{url('storage/app')}}/{{$lessonList->image}}">
                                            <h3>{{$lessonList->name}}</h3>

                                            <label><i class="far fa-clock"></i> المدة
                                                <span>{{$lessonList->time}}</span></label>

                                            <a href="{{route('site::lesson',[ 'id' => $lessonList->id ])}}"
                                               class="stretched-link"></a>

                                        </div>

                                    @endforeach
                                @else
                                    <div class="alert alert-danger">{{__('Empty data')}}</div>
                                @endif
                            </div>

                        </div>


                        <div class="col-lg-4 line">

                            <div class="time-date">
                                <h3 class="title-side">الوقت والتاريخ</h3>
                                <span><i
                                        class="far fa-clock"></i> {{$lesson->course->date_time->format("H:i")}} {{period($lesson->course->date_time->format("A"))}}</span>
                                <span><i class="far fa-calendar-alt"></i> {{$lesson->course->date_time->format("Y-m-d")}}</span>
                            </div>

                            <div class="course-map">

                                <h3 class="title-side">مكان الدورة</h3>

                                <div class="course-place">
                                    <div id="map_canvas" class="maps" style="width:100%; height:350px;"></div>
                                </div>

                                <h4><i class="fas fa-map-marker-alt"></i>{{$lesson->course->address}}</h4>

                            </div>

                            <div class="time-date contact-info">

                                <h3 class="title-side">للتواصل والإستفسارات</h3>
                                <span><i class="fas fa-phone"></i> {{$lesson->course->trainer ? $lesson->course->trainer->mobile : "غير محدد"}}</span>
                                <span><i class="far fa-envelope"></i> {{$lesson->course->trainer ? $lesson->course->trainer->email : "غير محدد"}}</span>


                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="share-course">

                        <h3>مشاركة</h3>

                        <ul>
                            <li>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
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

                                @foreach(\App\Course::limit(5)->orderBy('id','DESC')->get() as $lesson->course)

                                    <div class="card">
                                        <a href="{{route('site::course',$lesson->course->id)}}" class="thumb-link">
                                            <img src="{{url('storage/app')}}/{{$lesson->course->image}}"
                                                 class="card-img-top">
                                            <i>معرفة المزيد</i>
                                        </a>
                                        @if($lesson->course->free)
                                            <span class="price free">مجاناً</span>
                                        @else
                                            <span class="price">{!! $lesson->course->price ? intval($lesson->course->price) ."<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{$lesson->course->name}}</h5>
                                            <p class="card-text">{{ Str::limit( strip_tags($lesson->course->description) , 200 ) }}</p>
                                            <span class="star">4.5 <i class="fas fa-star"></i></span> <span>2K <i
                                                    class="fas fa-user"></i></span> <a href="#" class="btn">تسجيل
                                                بالدورة</a>
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

            var stockholm = new google.maps.LatLng{{$lesson->course->coordinates}};
            var parliament = new google.maps.LatLng{{$lesson->course->coordinates}};
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
