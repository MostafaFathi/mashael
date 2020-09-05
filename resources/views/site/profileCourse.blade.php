@extends('site.layouts.app')

@section('title',__('Profile'))
@section('content')

    <div class="page-breadcrumb breadcrumb-personal">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>الصفحة الشخصية</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{route('site::profile')}}">الصفحة الشخصية</a></li>
                        <li class="breadcrumb-item active">{{$user->name}}</li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>

    <section class="page-personal">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="header-profile">

                        <div class="tools">
                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="خروج"><i class="fas fa-sign-out-alt"></i></a>
                        </div>

                        <div class="info-profile">

                            <img src="{{url('storage/app')}}/{{$user->image}}">

                            <h3>{{$user->name}}</h3>

                            <span><i class="far fa-calendar-alt"></i> {{$user->birthday}} <!-- <span>0 exp</span> <i class="fas fa-award"></i> --></span>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="tabs-profile">

                        <div class="tabs-course">
                            <a href="{{route('site::profile')}}"><i class="far fa-address-card"></i> بياناتي</a>
                            <a href="{{route('site::profile.course')}}" class="active"><i class="fas fa-box-open"></i>
                                الدورات المسجلة</a>
                            <a href="{{route('site::profile.question')}}"><i class="far fa-comments"></i> الأسئلة المطروحة</a>
                            <a href="{{route('site::profile.addQuestion')}}"><i class="far fa-comment-dots"></i> اسأل مشاعل</a>
                        </div>

                    </div>

                </div>

                <div class="col-lg-12">


                    <div class="title-profile">
                        <h3><i class="fas fa-box-open"></i> الدورات المسجلة</h3>
                    </div>

                    @foreach($user->courses as $course)

                        <div class="block-mycourses">

                            <div class="meta-mycourses">

                                <label> عدد المسجلين <span>({{$course->users->count()}} مشترك)</span> </label>

                                <label>
                                    تقييم الدورة
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5"><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4 and a half"><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4"><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3 and a half"><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3"><label class="full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2 and a half"><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2"><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1 and a half"><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1"><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                    </fieldset>
                                    <span class="rev">({{$course->rates->count()}} REVIEWS)</span>
                                </label>

                                <label> القسم <span> {{$course->categories->pluck('name')->implode(',')}}</span>
                                </label>

                            </div>

                            <img src="{{url('storage/app')}}/{{$course->image}}">

                            <h3>{{$course->name}}</h3>

                            <p>{{ Str::limit( strip_tags($course->description) , 300 ) }}</p>

                            <div class="time-mycourses">

                                <label>الوقت والتاريخ</label>

                                <span><i class="far fa-clock"></i>  {{$course->date_time->format('H:m')}} {{period($course->date_time->format("A"))}}</span>

                                <span><i class="far fa-calendar-alt"></i> <i>{{$course->date_time->format('d')}}</i> {{months($course->date_time->format('m'))}} {{$course->date_time->format('Y')}}</span>

                            </div>

                            <a href="{{route('site::course',$course->id)}}" class="cancel-mycourses">تفاصيل</a>
{{--                            <a href="#" class="cancel-mycourses">إلغاء الدورة</a>--}}

                        </div>

                    @endforeach
                </div>

            </div>

        </div>

        </div>

    </section>

@endsection
