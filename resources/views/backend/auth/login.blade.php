<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bookcloud</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/backend/auth/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/backend/auth/css/util.css">
    <link rel="stylesheet" type="text/css" href="/backend/auth/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background: #f8694a;">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="{{ route('login.store') }}">
                @csrf
                <span class="login100-form-title p-b-49 ">
{{--						Đăng nhập--}}
                        <h1>Book<span style="color: #F8694A">cloud</span></h1>
					</span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Email không được bỏ trống">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="email" placeholder="">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <span class="focus-input100" data-symbol="&#xf108;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Mật khẩu không được bỏ trống">
                    <span class="label-input100">Mật khẩu</span>
                    <input class="input100" type="password" name="password" placeholder="">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>
                @if(session()->has('fail'))
                    <div class="alert alert-danger">{!! session('fail') !!}</div>
                @endisset
                <div style="margin-top: 50px; text-align: center">
                    <button class="btn btn--radius-2 btn--red"
                            style="background: #f8694a; color: white; padding: 15px 30px 15px 30px; font-size: 16px;">
                        Đăng nhập
                    </button>
                </div>
                <h5 style="text-align: center; margin: 10px">Hoặc</h5>
                <div style="margin: 10px; text-align: center">
                    <a style="    padding: 15px 35px 15px 35px;" href="{{ route('login.google') }}"
                       class="btn btn-primary"><i class="fa fa-google"></i>
                        Google</a>
                </div>
                <div style="text-align: center; margin-top: 25px"><a style="font-family: none; font-size: 18px"
                                                                     href="{{route('register.form')}}">Bạn chưa có tài
                        khoản?</a></div>

                {{--                <h4 style="text-align: center; margin-top: 10px"> Hoặc</h4>--}}
                {{--                <div style="margin-top: 10px; text-align: center">--}}
                {{--                    <a href="{{route('register.form')}}" class="btn btn--radius-2 btn--red"--}}
                {{--                       style="background: #f8694a; color: white;padding: 15px 30px 15px 30px; font-size: 16px;">--}}
                {{--                        Đăng ký ngay--}}
                {{--                    </a>--}}
                {{--                </div>--}}

                {{--                <div class="txt1 text-center p-t-54 p-b-20">--}}
                {{--						<span>--}}
                {{--							Đăng nhập bằng--}}
                {{--						</span>--}}
                {{--                </div>--}}

                {{--                <div class="flex-c-m">--}}
                {{--                    <a href="#" class="login100-social-item bg1">--}}
                {{--                        <i class="fa fa-facebook"></i>--}}
                {{--                    </a>--}}

                {{--                    <a href="#" class="login100-social-item bg2">--}}
                {{--                        <i class="fa fa-twitter"></i>--}}
                {{--                    </a>--}}

                {{--                    <a href="#" class="login100-social-item bg3">--}}
                {{--                        <i class="fa fa-google"></i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}

                {{--                <div class="flex-col-c p-t-155">--}}

                {{--                    <a href="{{ route('register.form') }}" class="txt2">--}}
                {{--                        Đăng kí tài khoản--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="/backend/auth/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/backend/auth/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/backend/auth/vendor/bootstrap/js/popper.js"></script>
<script src="/backend/auth/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/backend/auth/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/backend/auth/vendor/daterangepicker/moment.min.js"></script>
<script src="/backend/auth/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/backend/auth/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="/backend/auth/js/main.js"></script>

</body>
</html>
