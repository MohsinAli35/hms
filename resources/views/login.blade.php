<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/logo1.png')}}">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                   
                    <form action="{{route('login.check')}}" method="POST">
                        @method('POST')
                        @csrf
						<div class="account-logo">
                            <a href="{{route('home')}}"><img src="{{asset('assets/img/logo1.png')}}" alt=""></a>
                        </div>
                        @if (session('danger'))
                        <span class="text-danger fs-6 my-2">{{session('danger')}}</span>
                    @endif
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required autofocus="" class="form-control">
                            @error('email')
                                <span class="text-danger mt-1 fs-6">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required class="form-control">
                            @error('password')
                                <span class="text-danger mt-1 fs-6">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            {{-- <a href="forgot-password.html">Forgot your password?</a> --}}
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <!-- <div class="text-center register-link">
                            Don’t have an account? <a href="register.html">Register Now</a>
                        </div>-->
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>