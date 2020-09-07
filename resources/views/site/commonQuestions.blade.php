@extends('site.layouts.app')

@section('title',__('Profile'))
@section('content')

    <div class="page-breadcrumb breadcrumb-personal">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>الاسئلة الشائعة</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('site::profile')}}">الاسئلة الشائعة</a></li>
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
                                <div class="block-mycourses block-answer">



                                    <h3>{{$question->name}}</h3>



                                    <a class="cancel-mycourses" data-toggle="collapse"
                                       href="#collapseExample{{$question->id}}" role="button" aria-expanded="false"
                                       aria-controls="collapseExample{{$question->id}}">تفاصيل</a>
                                    {{--<a href="#" class="cancel-mycourses">إلغاء الدورة</a>--}}


                                    <div class="collapse" id="collapseExample{{$question->id}}">
                                        <p>{!! $question->description !!}</p>
                                            <div class="answer-body">
                                                {!! $question->answer !!}
                                            </div>
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
