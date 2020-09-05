@extends('site.layouts.app')

@section('title',$category->name)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if($category->courses->count() > 0)
                @foreach($category->courses as $course)
                    <div class="card" style="width: 18rem;">
                        <img src="{{url('storage/app/'.$course->image)}}" class="card-img-top" alt="{{$course->name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$course->name}}</h5>
                            <p class="card-text">{{$course->description}}</p>
                            @if(!request('id'))
                                <ul>
                                    @foreach($course->categories as $categoryParent)
                                        <li>
                                            <a href="{{route('site::courses',[ 'id' => $categoryParent->id ])}}">{{$categoryParent->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{route('site::course',$course->id)}}"
                               class="btn btn-primary">{{__('Show details')}}</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-danger">{{__('Empty data')}}</div>
            @endif
        </div>
    </div>
@endsection
