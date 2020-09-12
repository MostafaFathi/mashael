<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ \App\Setting::getValue('name') }} - Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('WhiteAdmin')}}/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
    <!-- endinject -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('mashael')}}/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('mashael')}}/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('mashael')}}/images/favicon-16x16.png">
    <link rel="manifest" href="{{url('mashael')}}/images/site.webmanifest">

    <script src="https://cdn.tiny.cloud/1/xe8ditx94nk70u3tmzlxfmzcil3wfamu7nhrylmzoxf030pw/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea',
            plugins: 'print preview   importcss    autosave save     fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help   charmap   quickbars  emoticons ',

            mobile: {
                plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
            },
            menu: {
                tc: {
                    title: 'TinyComments',
                    items: 'addcomment showcomments deleteallconversations'
                }
            },
            menubar: 'file edit view insert format tools table tc help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'My page 1', value: 'http://www.tinymce.com' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'http://www.tinymce.com' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],importcss_append: true,
            templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            spellchecker_whitelist: ['Ephox', 'Moxiecode'],
            tinycomments_mode: 'embedded',
            content_style: '.mymention{ color: gray; }',
            contextmenu: 'link image imagetools table configurepermanentpen',
            a11y_advanced_options: true,
        });</script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @yield('header')

</head>
<body style="text-align: right">
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="{{url('/')}}"><img src="{{url('storage/app').'/'.\App\Setting::getValue('logo')}}"
                                                                          alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{url('storage/app').'/'.\App\Setting::getValue('logo')}}"
                                                                               alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-4 w-100">
                <li class="nav-item nav-search d-none d-lg-block w-100">
                    {{--                    <div class="input-group">--}}
                    {{--                        <div class="input-group-prepend">--}}
                    {{--                <span class="input-group-text" id="search">--}}
                    {{--                  <i class="mdi mdi-magnify"></i>--}}
                    {{--                </span>--}}
                    {{--                        </div>--}}
                    {{--                        <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">--}}
                    {{--                    </div>--}}
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
{{--                 <li class="nav-item dropdown mr-1">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                       id="messageDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-message-text mx-0"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">{{__('Contacts')}}</p>
                        @foreach(\App\Contact::limit(3)->get() as $contact)
                            <a class="dropdown-item" href="{{route('admin::contact.index')}}">
                                @if($contact->user)
                                    <div class="item-thumbnail">
                                        <img src="{{url('storage/app')}}/{{$contact->user->image}}" alt="image"
                                             class="profile-pic">
                                    </div>
                                @else
                                    <div class="item-thumbnail">
                                        <div class="item-icon bg-success">
                                            <i class="mdi mdi-information mx-0"></i>
                                        </div>
                                    </div>
                                @endif
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal">{{$contact->first_name}} {{$contact->last_name}}
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        {{$contact->title}}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                       id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-bell mx-0"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                         aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">{{__('Orders')}}}</p>

                        @foreach(\App\Order::limit(3)->get() as $order)
                            <a class="dropdown-item" href="{{route('admin::order.index')}}">

                                @if($order->user)
                                    <div class="item-thumbnail">
                                        <img src="{{url('storage/app')}}/{{$order->user->image}}" alt="image"
                                             class="profile-pic">
                                    </div>
                                @endif
                                <div class="item-content">
                                    <h6 class="font-weight-normal">{{$order->user->name}}</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        @if($order->course)
                                            {{ $order->course->name }}
                                        @elseif($order->worshop)
                                            {{ $order->worshop->name }}
                                        @elseif($order->session)
                                            {{ $order->session->name }}
                                        @else
                                            غير محدد
                                        @endif
                                    </p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </li>
               <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                       id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-information mx-0"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                         aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">{{__('Questions')}}</p>

                        @foreach(\App\Question::limit(3)->get() as $question)
                            <a class="dropdown-item" href="{{route('admin::question.index')}}">

                                @if($question->user)
                                    <div class="item-thumbnail">
                                        <img src="{{url('storage/app')}}/{{$question->user->image}}" alt="image"
                                             class="profile-pic">
                                    </div>
                                @endif
                                <div class="item-content">
                                    <h6 class="font-weight-normal">{{$question->user ? $question->user->name : "unknown"}}</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        {{$question->title}}
                                    </p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </li> --}}
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="https://www.coachmashael.com/mashael/images/icon.png" alt="profile"/>
                        <span
                            class="nav-profile-name">اعدادات الموقع {{-- {{auth()->guard('admin')->user()->firstname}} {{auth()->guard('admin')->user()->lastname}} --}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{url(config('app.admin_prefix').'/setting')}}">
                            <i style="color: #3a592a!important;font-size: 22px!important;" class="mdi mdi-settings text-primary ml-1"></i>
                            اعدادات الموقع
                        </a>
                        <a class="dropdown-item" href="{{ route('admin::logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i style="color: #3a592a!important;font-size: 22px!important;" class="mdi mdi-logout text-primary ml-1"></i>
                            تسجيل خروج
                        </a>
                        <form id="logout-form" action="{{ route('admin::logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->

    @include('admin.layouts.sidebar')

    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                @yield('content')

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{date('Y')}} . All rights reserved.</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

 <!-- End custom js for this page-->
@yield('footer')

</body>

</html>
