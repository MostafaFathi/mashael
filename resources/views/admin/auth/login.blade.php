<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="https://www.coachmashael.com/mashael/images/favicon.ico">

    <title>{{ \App\Setting::getValue('name') }} - Admin</title>

    <!-- page css -->

    <link href="{{url('admin')}}/css/pages/login-register-lock.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="{{url('admin')}}/css/style.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body class="skin-default card-no-border">

<!-- ============================================================== -->

<!-- Preloader - style you can find in spinners.css -->

<!-- ============================================================== -->

<div class="preloader">

    <div class="loader">

        <div class="loader__figure"></div>

        <p class="loader__label">{{env('APP_NAME')}} admin</p>

    </div>

</div>

<!-- ============================================================== -->

<!-- Main wrapper - style you can find in pages.scss -->

<!-- ============================================================== -->

<style type="text/css">
	.btn-info{
		background: #3a592a;
		border-color: #3a592a;
	}
	.btn-info:hover {
	    background-color: #c4a763;
	    border-color: #c4a763;
	}
    .login-register{
        background: #caa95d;
    }
</style>

<section id="wrapper">

    <div class="login-register" style="padding: 3% 0">

        	<a style="display: table;margin: auto;" href="https://www.coachmashael.com"><img width="170" class="mx-auto d-block mb-3" src="https://www.coachmashael.com/mashael/images/logofooter.png"></a> 

        <div class="login-box card">

            <div class="card-body">

                @if ($errors->has('email'))

                    <div class="alert alert-danger">

                        <strong>{{ $errors->first('email') }}</strong>

                    </div>

                @endif @if ($errors->has('password'))

                    <div class="alert alert-danger">

                        <strong>{{ $errors->first('password') }}</strong>

                    </div>

                @endif

                <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('admin::login') }}">

                    {{ csrf_field() }}

                    <h3 class="box-title m-b-20 text-center">{{__('Admin sign in')}}</h3>

                    <div class="form-group ">

                        <div class="col-xs-12">

                            <input class="form-control" type="text" name="email" value="{{ old('email') }}" required="" placeholder="{{__('Admin email')}}"> </div>

                    </div>

                    <div class="form-group">

                        <div class="col-xs-12">

                            <input class="form-control" type="password" name="password" required="" placeholder="{{__('Admin password')}}"> </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <div class="custom-control custom-checkbox float-right">

                                <input type="checkbox" class="custom-control-input" id="customCheck1">

                                <label class="custom-control-label" for="customCheck1">{{__('Remember me')}}</label>

                            </div>

                        </div>

                    </div>

                    <div class="form-group text-center">

                        <div class="col-xs-12 p-b-20">

                            <button class="btn btn-block btn-lg btn-info" type="submit">{{__('Login')}}</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

<!-- ============================================================== -->

<!-- End Wrapper -->

<!-- ============================================================== -->

<!-- ============================================================== -->

<!-- All Jquery -->

<!-- ============================================================== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<!-- Bootstrap tether Core JavaScript -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/esm/popper.js" integrity="sha256-xp3mHur7sqosKiJ81IZiZ0SyjjeMt0H0evjXzEzlwBI=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.js" integrity="sha256-pl1bSrtlqtN/MCyW8XUTYuJCKohp9/iJESVW1344SBM=" crossorigin="anonymous"></script>

<!--Custom JavaScript -->

<script type="text/javascript">
    $(function() {

        $(".preloader").fadeOut();

    });

    $(function() {

        $('[data-toggle="tooltip"]').tooltip()

    });

    // ==============================================================

    // Login and Recover Password

    // ==============================================================

    $('#to-recover').on("click", function() {

        $("#loginform").slideUp();

        $("#recoverform").fadeIn();

    });
</script>

</body>

</html>
