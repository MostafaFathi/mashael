@extends('site.layouts.app')

@section('title',$workshop->name)

@section('content')

    <div class="page-breadcrumb breadcrumb-courses">

        <div class="container">

            <h3>ورش العمل</h3>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{route('site::workshops')}}">ورش العمل</a></li>
                    <li class="breadcrumb-item active">{{$workshop->name}}</li>
                </ol>
            </nav>

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
                                        <span class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 0) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 1) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 2) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 3) ? "checked" :"" }}"></span>
                                        <span class="fa fa-star {{ ($workshop->rates->count() > 0 and 5 > $workshop->rates->sum('rate')/$workshop->rates->count() and  $workshop->rates->sum('rate')/$workshop->rates->count() > 4) ? "checked" :"" }}"></span>
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
                                    <span>{!! $workshop->price > 0 ? intval($workshop->price) . "<span class='font-def'>ريال</span>" : "<span class='font-def'>مجانا</span>" !!}</span>
                                    @if(!auth()->check() or !in_array($workshop->id,auth()->user()->courses->pluck('id')->toArray()))
                                        <a href="{{route('site::workshop_order',$workshop->id)}}">الإشتراك بالدورة</a>
                                    @else
                                        <a class="disabled" href="#"><i class="fas fa-check-circle"></i> أنت مشترك </a>
                                    @endif
                                </div>
                            </div>

                        </div>


                        <div class="thumb-course">
                            <img src="{{url('storage/app/'.$workshop->image)}}">
                            <span><i>{{$workshop->date_time->format('d')}}</i> {{months($workshop->date_time->format('m'))}} {{$workshop->date_time->format('Y')}}</span>
                        </div>


                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="tabs-course">

                        <a href="{{route('site::workshop',$workshop->id)}}"><i class="fas fa-desktop"></i>
                            نظرة عامة</a>
                        <a href="#"><i
                                class="fas fa-box-open"></i> محتوى الدورة</a>
                        <a href="{{ $workshop->trainer ? route('site::trainer',$workshop->trainer->id) : "#"}}"><i
                                class="fas fa-user"></i> نبذه عني</a>
                        <a href="{{route('site::workshop',$workshop->id)}}" class="active"><i class="fas fa-chart-line"></i>
                            التقييم والتعليقات</a>

                    </div>

                    <div class="row">

                        <div class="col-lg-8">

                            <!-- videos -->

                            <div class="rate-course">

                                @if($workshop->rates->count() > 0)
                                    @foreach($workshop->rates as $rate)
                                        <div class="comment">

                                            <img src="{{$rate->user->image ? url('storage/app/'.$rate->user->image) : url('mashael/images/clients.png') }}">

                                            <h3>{{$rate->user->name}}</h3>

                                            <p>{{$rate->comment}}</p>

                                        </div>
                                    @endforeach
                                @else
{{--                                    <div class="alert alert-danger">{{__("Empty data")}}</div>--}}
                                @endif

                            </div>

                            <form method="post" class="add-comment">
                                {{csrf_field()}}
                                <div class="add-rate">

                                    <label class="title"><img src="{{url('mashael')}}/images/rate.svg">تقييم
                                        الدورة</label>

                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rate" value="5"><label class="full"
                                                                                                      for="star5"
                                                                                                      title="Awesome - 5 stars"></label>
                                         </label>
                                        <input type="radio" id="star4" name="rate" value="4"><label class="full"
                                                                                                      for="star4"
                                                                                                      title="Pretty good - 4 stars"></label>
                                         </label>
                                        <input type="radio" id="star3" name="rate" value="3"><label class="full"
                                                                                                      for="star3"
                                                                                                      title="Meh - 3 stars"></label>
                                         </label>
                                        <input type="radio" id="star2" name="rate" value="2"><label class="full"
                                                                                                      for="star2"
                                                                                                      title="Kinda bad - 2 stars"></label>
                                         </label>
                                        <input type="radio" id="star1" name="rate" value="1"><label class="full"
                                                                                                      for="star1"
                                                                                                      title="Sucks big time - 1 star"></label>
                                    </fieldset>

                                </div>


                                <textarea class="form-control" name="comment" placeholder="أضف تعليق"></textarea>

                                <button class="send">أضف التعليق</button>

                            </form>


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

                                @foreach(\App\Workshop::limit(5)->orderBy('id','DESC')->get() as $workshop)

                                    <div class="card">
                                        <a href="{{route('site::workshop',$workshop->id)}}" class="thumb-link">
                                            <img src="{{url('storage/app')}}/{{$workshop->image}}" class="card-img-top">
                                            <i>معرفة المزيد</i>
                                        </a>
                                        @if($workshop->free)
                                            <span class="price free">مجاناً</span>
                                        @else
                                            <span class="price">{!! $workshop->price ? intval($workshop->price) ."<span class='font-def'>ريال</span>ريال" : "<span class='font-def'>مجانا</span>" !!}</span>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{$workshop->name}}</h5>
                                            <p class="card-text">{{ Str::limit( strip_tags($workshop->description) , 200 ) }}</p>
                                            <span class="star">0.0 <i class="fas fa-star"></i></span> <span>2K <i
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
