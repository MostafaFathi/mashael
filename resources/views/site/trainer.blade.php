@extends('site.layouts.app')

@section('title',$trainer->name)

@section('content')

    <div class="page-breadcrumb breadcrumb-contact">

        <div class="container">

            <div class="breadcrumb-center d-table">

                <h3>نبذة عني</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">نبذة عني</li>
                    </ol>
                </nav>
            </div>
            
        </div>

    </div>

    <section class="page-about">

        <div class="container">

            <div class="row ch-dir">

                <div class="col-lg-5 col-md-6 col-sm-12">

                    <div class="thumb-about">
                        <img src="{{url('storage/app')}}/{{$page->image}}">
                    </div>

                </div>

                <div class="col-lg-7 col-md-6">

                    <div class="word-about ml-5 clearfix">
                        <div class="titles clearfix">
                            <h5 class="d-table">أهلاً بكم جميعاً</h5>

                            <h3 class="d-table">{{$page->name}}</h3>

                            <h6 class="d-table">مدربة وعي وتطوير ذات</h6>
                        </div>

                        <p>{!! $page->description !!}</p>

                        <img src="{{url('mashael')}}/images/signature.png">

                    </div>

                    <div class="statistics ml-5 clearfix">

                        <ul>
                            <li> <i>{{\App\Setting::getValue('Training_course')}}+</i> دورة </li>
                            <li> <i>{{\App\Setting::getValue('Workshop')}}</i> ورشة عمل </li>
                            <li> <i>{{\App\Setting::getValue('Book_and_article')}}</i> مقال </li>
                            <li> <i>{{\App\Setting::getValue('clients')}}</i> عميل ومستمع </li>
                        </ul>

                    </div>

                </div>

            </div>

            <div class="welcome">

                <h3>أهلا بك في عالم تطوير الذات وتحقيق الأهداف</h3>

                <p>اتصل بنا لمزيد من المعلومات والاستفسارات عن الدورات القادمة وورش العمل</p>

                <ul>
                    <li><a href="{{route('site::courses')}}">الدورات</a></li>
                    <li><a href="{{route('site::workshops')}}">ورش العمل</a></li>
                    <li><a href="{{route('site::contactus')}}">اتصل بنا</a></li>
                </ul>

            </div>

            <div class="clearfix"></div>
            <div class="goals clearfix">

                <h2>لماذا أعطي الدورات وورش العمل؟</h2>

                <div class="row">
                    <div class="col-lg-4 col-sm-12">

                        <div class="goals-text">
                            <img src="{{url('storage/app')}}/{{$page4->image}}">
                            <h3>{{$page4->name}}</h3>
                            {!! $page4->description !!}
                        </div>

                    </div>    
                    <div class="col-lg-4 col-sm-12">

                        <div class="goals-text">
                            <img src="{{url('storage/app')}}/{{$page2->image}}">
                            <h3>{{$page2->name}}</h3>
                            {!! $page2->description !!}
                        </div>

                    </div>    
                    <div class="col-lg-4 col-sm-12">

                        <div class="goals-text">
                            <img src="{{url('storage/app')}}/{{$page3->image}}">
                            <h3>{{$page3->name}}</h3>
                            {!! $page3->description !!}
                        </div>

                    </div>    

                </div>

            </div>

        </div>

    </section>


@endsection
