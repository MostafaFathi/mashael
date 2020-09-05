@extends('site.layouts.app')

@section('title',$page->name)

@section('content')

    <div class="page-breadcrumb">

        <div class="container">
            <div class="breadcrumb-center d-table">
                <h3>{{$page->name}}</h3>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site::home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">{{$page->name}}</li>
                    </ol>
                </nav>

           </div>

        </div>

    </div>

    <div class="container">
        <div class="content-page">
            <!-- <img class="img-page" src="{{url('storage/app/'.$page->image)}}"> -->
            <p>{!! $page->description !!}</p>
        </div>
    </div>
@endsection
