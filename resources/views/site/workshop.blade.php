@extends('site.layouts.app')

@section('title',$workshop->name)

@section('content')

    <div class="page-breadcrumb breadcrumb-courses-sn">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>ورش العمل</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::workshops')}}">ورش العمل</a></li>
                        <li class="breadcrumb-item active">{{$workshop->name}}</li>
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

                        <h3>{{$workshop->name}}</h3>

                        <div class="row">

                            <div class="col-lg-8">

                                <div class="block-details">
                                    <label>تقييم الدورة</label>
                                    <fieldset class="rating">
                                        <span
                                            class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 0) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 1) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 2) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 3) ? "checked" :"" }}"></span>
                                        <span
                                            class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 4) ? "checked" :"" }}"></span>
                                    </fieldset>
                                    <span class="rev">({{$workshop->rates->count()}} REVIEWS)</span>

                                </div>
                                <div class="block-details">
                                    <label>القسم</label>
                                    <span>{{ implode(",",$workshop->categories->pluck('name')->toArray()) }}</span>
                                </div>
                                <div class="block-details">
                                    <label>نوع الدورة</label>
                                    <span>{{$workshop->type ? $workshop->type->name : "غير محدد"}}</span>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="join-course">

                                    <span>{!! $workshop->price > 0 ? intval($workshop->price) . " <span class='font-def'>ريال</span>" : " <span class='font-def'>مجانا</span>" !!}</span>
                                    @if($workshop->register_status == 0)
                                    <a href="#" class="disabled">قريبا</a>
                                    @else
                                        @if($workshop->persons != 0 and $workshop->persons <= $workshop->orders->count())
                                            @if( !auth()->check() or !in_array($workshop->id,auth()->user()->workshops->pluck('id')->toArray()))
                                                <a href="#" class="disabled">انتهى التسجيل</a>
                                            @else
                                                <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                                    مشترك
                                                </a>
                                            @endif
                                        @else
                                            @if( !auth()->check() or !in_array($workshop->id,auth()->user()->workshops->pluck('id')->toArray()))
                                                <a href="{{route('site::workshop_order',$workshop->id)}}">الإشتراك بورشة
                                                    العمل</a>
                                            @else
                                                <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                                    مشترك
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="thumb-course">
                            <img src="{{url('storage/app/'.$workshop->image)}}">
                            <span><i>{{$workshop->date_time->format('d')}}</i> {{months($workshop->date_time->format('m'))}} {{$workshop->date_time->format('Y')}}</span>
                        </div>

                        <div class="row">

                            <div class="offset-lg-8 col-lg-4">
                                <div class="join-course">
                                    <span>{!! $workshop->price > 0 ? intval($workshop->price) . " <span class='font-def'>ريال</span>" : " <span class='font-def'>مجانا</span>" !!}</span>
                                    @if($workshop->register_status == 0)
                                        <a href="#" class="disabled">قريبا</a>
                                    @else
                                        @if($workshop->persons != 0 and $workshop->persons <= $workshop->orders->count())

                                            @if( !auth()->check() or !in_array($workshop->id,auth()->user()->workshops->pluck('id')->toArray()))
                                                <a href="#" class="disabled">انتهى التسجيل</a>
                                            @else
                                                <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                                    مشترك
                                                </a>
                                            @endif
                                        @else
                                            @if( !auth()->check() or !in_array($workshop->id,auth()->user()->workshops->pluck('id')->toArray()))
                                                <a href="{{route('site::workshop_order',$workshop->id)}}">الإشتراك بورشة
                                                    العمل</a>
                                            @else
                                                <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت
                                                    مشترك
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="tabs-course">

                        <a href="{{route('site::workshop',$workshop->id)}}" class="active"><i
                                class="fas fa-desktop"></i> نظرة عامة</a>
                        <a href="#"><i class="fas fa-box-open"></i> محتوى ورشة العمل</a>
                        <a href="{{ $workshop->trainer ? route('site::trainer',$workshop->trainer->id) : "#"}}"><i
                                class="fas fa-user"></i> نبذه عني</a>
                        <a href="{{route('site::comment_workshop',$workshop->id)}}"><i class="fas fa-chart-line"></i>
                            التقييم والتعليقات</a>

                    </div>

                    <div class="row">

                        <div class="col-lg-8">

                            <div class="description">
                                @if($workshop->intro_image)

                                    <img class="intro_image" src="{{$workshop->intro_image}}">

                                @endif
                                @if($workshop->intro)
                                    <h3 class="title-side">فيديو تعريفي</h3>
                                    @if(strpos($workshop->intro, 'facebook') !== false)
                                        <iframe width="100%" height="615"
                                                src="https://www.facebook.com/v2.3/plugins/video.php?allowfullscreen=true&autoplay=true&container_width=800&locale=en_US&sdk=joey&href={{$workshop->intro}}"
                                                frameborder="0"></iframe>
                                    @endif
                                    @if(strpos($workshop->intro, 'youtube') !== false)
                                        <iframe width="100%" height="615"
                                                src="{{str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$workshop->intro)}}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    @endif
                                    @if(strpos($workshop->intro, 'vimeo') !== false)
                                        <iframe
                                            src="{{str_replace("https://vimeo.com/","https://player.vimeo.com/video/",$workshop->intro)}}"
                                            width="100%" height="615" frameborder="0" allow="autoplay; fullscreen"
                                            allowfullscreen></iframe>
                                    @endif
                                    @if(strpos($workshop->intro, '/storage/lessons/') !== false)
                                        <video width="100%" height="615" controls>
                                            <source src="{{$workshop->intro}}" type="video/mp4">
                                            {{__('Your browser does not support HTML5 video')}}
                                        </video>
                                    @endif
                                @endif

                                {!! $workshop->description !!}
                            </div>

                        </div>


                        <div class="col-lg-4 line">

                            <div class="time-date">
                                <h3 class="title-side">الوقت والتاريخ</h3>
                                <span><i
                                        class="far fa-clock"></i> {{$workshop->date_time->format("H:i") }} {{period($workshop->date_time->format("A"))}}</span>
                                <span><i
                                        class="far fa-calendar-alt"></i> {{$workshop->date_time->format("d")}}  {{months($workshop->date_time->format('m'))}}  {{$workshop->date_time->format('Y')}}</span>
                            </div>

                            <div class="course-map">

                                <h3 class="title-side">مكان الدورة</h3>

                                <div class="course-place">
                                    <div id="map_canvas" class="maps" style="width:100%; height:350px;"></div>
                                </div>

                                <h4><i class="fas fa-map-marker-alt"></i>{{$workshop->address}}</h4>

                            </div>

                            <div class="time-date contact-info">

                                <h3 class="title-side">للتواصل والإستفسارات</h3>
                                <span><i class="fas fa-phone"></i> {{$workshop->trainer ? $workshop->trainer->mobile : "غير محدد"}}</span>
                                <span><i class="far fa-envelope"></i> {{$workshop->trainer ? $workshop->trainer->email : "غير محدد"}}</span>


                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="share-course">

                        <h3>مشاركة</h3>

                        <ul>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('site::workshop',$workshop->id)}}"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?url={{route('site::workshop',$workshop->id)}}&text={{$workshop->name}}"><i
                                        class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('site::workshop',$workshop->id)}}"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li>
                                <a href="whatsapp://send?text={{route('site::workshop',$workshop->id)}} {{$workshop->name}}"><i
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

                                @foreach(\App\workshop::limit(5)->orderBy('id','DESC')->get() as $workshop)

                                    <div class="card">
                                        <a href="{{route('site::workshop',$workshop->id)}}" class="thumb-link">
                                            <img src="{{url('storage/app')}}/{{$workshop->image}}" class="card-img-top">
                                            <i>معرفة المزيد</i>
                                        </a>
                                        @if($workshop->free)
                                            <span class="price free">مجاناً</span>
                                        @else
                                            <span
                                                class="price">{!! $workshop->price ? intval($workshop->price) ." <span class='font-def'>ريال</span>" : " <span class='font-def'>مجانا</span>" !!}</span>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{$workshop->name}}</h5>
                                            <p class="card-text">{{ Str::limit( strip_tags($workshop->description) , 200 ) }}</p>
                                            <span class="star"> {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 0) ?  number_format($workshop->rates->sum('rate')/$workshop->rates->count(), 2, ',', ' ') :"0.0" }} <i
                                                    class="fas fa-star"></i></span> <span> {{$workshop->users->count()}} <i
                                                    class="fas fa-user"></i></span>

                                            <a href="{{route('site::workshop_order',$workshop->id)}}" class="btn">تسجيل
                                                بورشة العمل</a>
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

            var stockholm = new google.maps.LatLng{{$workshop->coordinates}};
            var parliament = new google.maps.LatLng{{$workshop->coordinates}};
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
