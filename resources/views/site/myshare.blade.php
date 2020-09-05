@extends('site.layouts.app')

@section('title',$myshare->name)

@section('content')

    <div class="page-breadcrumb">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>{{$myshare->name}}</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">{{$myshare->name}}</li>
                    </ol>
                </nav>

           </div>

        </div>

    </div>

    <div class="container">
        <div class="content-page">

            <div class="description">
                <h3 class="title-side">{{$myshare->name}}</h3>
                <p>{!! $myshare->description !!}</p>
                <iframe style="display: table; margin: auto;"
                     width="560" height="315" 
                     src="{{str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$myshare->url)}}" 
                     frameborder="0" allowfullscreen>
                </iframe>
            </div>


{{--             <img src="{{url('storage/app')}}/{{$myshare->image}}" class="card-img-top">
            <span class="online">{{$myshare->type}}</span>
            <div class="card-body">
                <h5 class="card-title">{{$myshare->name}}</h5>
                <span class="time"><i
                        class="far fa-clock"></i> {{$myshare->created_at->format('H:m')}} {{period($myshare->created_at->format("A"))}}</span>
                <p class="card-text">{{ Str::limit( strip_tags($myshare->description) , 140 ) }}</p>
                {{$myshare->url}}
            </div> --}}
        </div>
    </div>
@endsection
