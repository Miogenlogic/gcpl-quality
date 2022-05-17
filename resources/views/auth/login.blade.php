<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Login to QMS dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('public/assets/img/brand/favicon.png?v=1.1.0')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/main-style.css?v=1.1.0')}}" type="text/css">
</head>

<body class="bg-default">
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-5">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white font-weight-500">Welcome!</h1>
                        <p class="text-lead text-white">Use this for to login to <strong>QMS</strong> portal. Put your credentials below</p> 
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-2"><img src="{{URL::asset('public/assets/img/brand/edm_05.jpg')}}" style="width: 190px"></div>
                        <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon login-btc">
                                <span class="btn-inner--text">QMS</span>
                            </a>
                        </div>
                    </div>

                    <?php if(isset($validation)){ ?>
                    <span style="padding-left: 100px;padding-top: 10px;color: red;">{{$validation}}</span>


                    <?php } ?>
                    <div class="card-body px-lg-5 pt-lg-5 pb-lg-4">
                        <form role="form" method="post" action="{{url('loginchk')}}">
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    {{--<input type="text" name="section_id" class="form-control" placeholder="Your section" required>--}}
                                    <select name="location_id" id="location_id" class="form-control"  required>
                                        @php
                                            $location=App\Helpers\UserHelper:: location();
                                        @endphp


                                        @foreach($location as $loc)

                                            <option value="{{$loc->id}}">{{$loc->description}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    {{--<input type="text" name="section_id" class="form-control" placeholder="Your section" required>--}}
                                    <select name="section_id" id="section_id" class="form-control"  required>
                                        @php
                                            $section=App\Helpers\UserHelper:: departmentname();
                                        @endphp


                                        @foreach($section as $bran)

                                            <option value="{{$bran->id}}">{{$bran->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input type="email" name="username" class="form-control" placeholder="User name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Your password" required>
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Remember me</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="btn btn-primary my-4" type="submit" value="Login">
                                <!--<button type="button" class="btn btn-primary my-4">Sign in</button>-->
                            </div>
							<a href="{{url('/forgot-password')}}" style="padding-left: 110px;">Forgot Password?</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-12">
                <div class="copyright text-center text-muted">
                    &copy; 2019 <b class="font-weight-bold ml-1" target="_blank">Gainwell commosales pvt. ltd.</b>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="{{URL::asset('public/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{URL::asset('public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('public/assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{URL::asset('public/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{URL::asset('public/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{URL::asset('public/assets/js/main.js?v=1.1.0')}}"></script>
</body>

</html>
