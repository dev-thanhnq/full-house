<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Bookcloud</title>

    <!-- Icons font CSS-->
    <link href="/backend/auth/register/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="/backend/auth/register/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="/backend/auth/register/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/backend/auth/register/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/backend/auth/register/css/main.css" rel="stylesheet" media="all">
</head>

<body style="background: #f8694a;">
<div class="page-wrapper p-t-45 p-b-50" >
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Đăng ký tài khoản Bookcloud</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="name">Họ và tên</div>
                        <div class="value">
                            <div class="input-group">
                                <input placeholder="Nhập tên" class="input--style-5" type="text" name="name">
                                @error('name')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Email</div>
                        <div class="value">
                            <div class="input-group">
                                <input placeholder="Nhập email" class="input--style-5" type="email" name="email">
                                @error('email')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Mật khẩu</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="password" name="password">
                                @error('password')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Xác nhận mật khẩu</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="password" name="password_confirmation">
                                @error('password_confirmation')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Số điện thoại</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" placeholder="Nhập số điện thoại" type="text" name="phone">
                                @error('phone')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Địa chỉ</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" placeholder="Nhập địa chỉ" name="address">
                                @error('address')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <button class="btn btn--radius-2 btn--red" type="submit" style="background: #f8694a;">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="/backend/auth/register/vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="/backend/auth/register/vendor/select2/select2.min.js"></script>
<script src="/backend/auth/register/vendor/datepicker/moment.min.js"></script>
<script src="/backend/auth/register/vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="/backend/auth/register/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
