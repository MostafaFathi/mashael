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
                            <a href="{{route('site::profile.question')}}"><i class="far fa-comments"></i> الأسئلة
                                المطروحة</a>
                            <a href="{{route('site::profile.addQuestion')}}" class="active"><i
                                    class="far fa-comment-dots"></i> اسأل مشاعل</a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">


                    <div class="title-profile">
                        <h3><i class="far fa-comment-dots"></i>ضع سؤالك ولا تتردد</h3>
                    </div>

                    <form method="post" class="add-comment">
                        {{csrf_field()}}

                        <input class="form-control" name="title" placeholder="عنوان السؤال">

                        <textarea class="form-control" name="question" placeholder="أضف السؤال"></textarea>

                        <button class="send">أضف السؤال</button>

                    </form>


                </div>

            </div>

        </div>

        </div>

    </section>

@endsection
