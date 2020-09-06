@extends('site.layouts.app')

@section('title',__('Profile'))
@section('content')

    <div class="page-breadcrumb breadcrumb-personal">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>اسأل مشاعل</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('site::profile')}}">اسأل مشاعل</a></li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>

    <section class="page-personal">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">


                    @if($questions->count() > 0)
                        @foreach($questions as $question)
                            @if($question->answers->count() > 0)
                                <div class="block-mycourses block-answer">

                                    <div class="meta-mycourses">

                                        <label> عدد الاجابات <span>({{$question->answers->count()}} اجابة)</span>
                                        </label>

                                    </div>

                                    <h3>{{$question->title}}</h3>

                                    <div class="time-mycourses">

                                        <label>الوقت والتاريخ</label>

                                        <span><i
                                                class="far fa-clock"></i>  {{$question->created_at->format('H:m')}} {{period($question->created_at->format("A"))}}</span>

                                        <span><i
                                                class="far fa-calendar-alt"></i> {{$question->created_at->format('d')}} {{months($question->created_at->format('m'))}} {{$question->created_at->format('Y')}}</span>

                                    </div>

                                    <a class="cancel-mycourses" data-toggle="collapse"
                                       href="#collapseExample{{$question->id}}" role="button" aria-expanded="false"
                                       aria-controls="collapseExample{{$question->id}}">تفاصيل</a>
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
                            @endif
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
