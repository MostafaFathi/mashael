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
                            <label href="#" for="image-user" data-toggle="tooltip" data-placement="top" title="تعديل الصورة"><i class="fas fa-pen"></i></label>
                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="خروج"><i class="fas fa-sign-out-alt"></i></a>
                        </div>

                        <div class="info-profile">

                            <img src="{{url('storage/app')}}/{{$user->image}}">

                            <h3>{{$user->name}}</h3>

                            <span><i class="far fa-calendar-alt"></i> {{$user->birthday}} <!-- <span>0 exp</span>  <i class="fas fa-award"></i>--></span>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="tabs-profile">

                        <div class="tabs-course">

                            <a href="{{route('site::profile')}}" class="active"><i class="far fa-address-card"></i> بياناتي</a>
                            <a href="{{route('site::profile.course')}}"><i class="fas fa-box-open"></i>
                                الدورات المسجلة</a>
                            <a href="{{route('site::profile.question')}}"><i class="far fa-comments"></i> الأسئلة المطروحة</a>
                            <a href="{{route('site::profile.addQuestion')}}"><i class="far fa-comment-dots"></i> اسأل مشاعل</a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="title-profile">
                        <h3><i class="far fa-address-card"></i>  بياناتي</h3>
                    </div>

                    <div class="profile page-payment">

                        <form method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image-user" name="image" aria-describedby="inputGroupFileAddon04">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}" placeholder="الإسم الأول">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="lastname" value="{{$user->lastname}}" placeholder="الإسم الأخير">
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="البريد الإلكتروني" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="رقم الهاتف" name="mobile" value="{{$user->mobile}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="تاريخ الميلاد" name="birthday" value="{{$user->birthday}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-map"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="اسم الشارع" name="street" value="{{$user->street}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="المدينة" name="city" value="{{$user->city}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-signs"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="رمز المنطقة" name="post_code" value="{{$user->post_code}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="الدولة" name="country" value="{{$user->country}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="الحي أو المنطقة" name="area" value="{{$user->area}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <button class="save">حفظ التعديلات</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
