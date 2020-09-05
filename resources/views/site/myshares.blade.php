@extends('site.layouts.app')

@section('title',__('My shares'))

@section('content')

    <div class="page-breadcrumb">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>{{__('My shares')}}</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">{{__('My shares')}}</li>
                    </ol>
                </nav>

           </div>

        </div>

    </div>

    <section class="page-myshares">

        <div class="container">

            <div class="all-myshares all-courses">

                <div class="row">

                    @foreach($myshares as $myshare)


                        <div class="col-lg-4 col-md-4 col-sm-6">

                            <div class="card">
                                @if($myshare->image)
                                    <img src="{{url('storage/app')}}/{{$myshare->image}}" class="card-img-top">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$myshare->name}}</h5>
                                    <p class="card-text">{{ Str::limit( strip_tags($myshare->description) , 140 ) }}</p>
                                    <a class="btn" href="{{route('site::myshare',$myshare->id)}}">التفاصيل</a>
                                </div>
                            </div>


{{--                             <div class="card">
                                @if($myshare->image)
                                    <img src="{{url('storage/app')}}/{{$myshare->image}}" class="card-img-top">
                                @endif
                                <span class="online">{{$myshare->type}}</span>
                                <div class="card-body">
                                    <h5 class="card-title">{{$myshare->name}}</h5>
                                    <span class="time"><i
                                            class="far fa-clock"></i> {{$myshare->created_at->format('Y-m-d')}} {{$myshare->created_at->format('H:m')}} {{period($myshare->created_at->format("A"))}}</span>
                                    <p class="card-text">{{ Str::limit( strip_tags($myshare->description) , 140 ) }}</p>
                                    {{$myshare->url}}
                                    <a class="btn" href="{{route('site::myshare',$myshare->id)}}"><i
                                            class="fas fa-check-circle"></i> مشاهدة </a>
                                </div>
                            </div> --}}

                        </div>
                    @endforeach

                </div>
                <div class="navigation">
                    {{$myshares->links()}}
                </div>

            </div>

        </div>

    </section>

@endsection

