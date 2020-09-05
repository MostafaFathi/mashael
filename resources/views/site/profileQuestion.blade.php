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
                            <a href="{{route('site::profile.course')}}"><i class="fas fa-box-open"></i>
                                الدورات المسجلة</a>
                            <a href="{{route('site::profile.question')}}" class="active"><i class="far fa-comments"></i>
                                الأسئلة المطروحة</a>
                            <a href="{{route('site::profile.addQuestion')}}"><i class="far fa-comment-dots"></i> ضع
                                سؤالك هنا</a>


                        </div>

                    </div>

                </div>

                <div class="col-lg-12">


                    <div class="title-profile">
                        <h3><i class="far fa-comments"></i>الأسئلة المطروحة</h3>
                    </div>
                    @if($user->questions->count() > 0)
                        @foreach($user->questions as $question)

                            <div class="block-mycourses block-answer">

                                <div class="meta-mycourses">

                                    <label> عدد الاجابات <span>({{$question->answers->count()}} اجابة)</span> </label>

                                </div>

                                <h3>{{$question->title}}</h3>

                                <div class="time-mycourses">

                                    <label>الوقت والتاريخ</label>

                                    <span><i
                                            class="far fa-clock"></i>  {{$question->created_at->format('H:m')}} {{period($question->created_at->format("A"))}}</span>

                                    <span><i
                                            class="far fa-calendar-alt"></i> {{$question->created_at->format('d')}} {{months($question->created_at->format('m'))}} {{$question->created_at->format('Y')}}</span>

                                </div>

                                <a  class="cancel-mycourses" data-toggle="collapse" href="#collapseExample{{$question->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$question->id}}">تفاصيل</a>
                                {{--<a href="#" class="cancel-mycourses">إلغاء الدورة</a>--}}

                                <div class="clearfix"></div>
                                <br>
                                <div class="collapse" id="collapseExample{{$question->id}}">
                                    <p>{{$question->question}}</p>
                                    @if($question->answers->count() >  0)
                                    <div class="answer-body">
                                        {!! $question->answers->pluck('answer')->implode("<br><br>") !!}
                                    </div>
                                    @else
                                        <div class="alert alert-danger">لا توجدة اجابة</div>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="alert alert-danger">{{__('Empty Data')}}</div>
                    @endif
                </div>

            </div>

        </div>

        </div>

    </section>

@endsection
