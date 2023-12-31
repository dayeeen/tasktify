<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="icon" href="img/icon-mt.png" type="image/png">
    <title>Register | Login</title>
</head>
<body>
<div class="materialContainer">
    <form action="/login" method="post" id="loginForm">
        @csrf
        <div class="box">
            @if(session('success'))
                <strong>{{ session('success') }}</strong> Please login to continue.
            @endif
            @if(session('loginError'))
                <strong>{{ session('loginError') }}</strong> Please try again.
            @endif
            <div class="title">LOGIN</div>
            <p>Don't have an account? Click on the '+' icon.</p>
            <div class="input">
               <label for="name">Username</label>
               <input type="text" name="username"   id="name" required>
               <span class="spin"></span>
            </div>
            <div class="input">
               <label for="pass">Password</label>
               <input type="password" name="password" id="pass" required>
               <span class="spin"></span>
            </div>
            <div class="button login">
               <button><span>GO</span> <i class="fa fa-check">Processing...</i></button>
            </div>
            <a href="" class="pass-forgot">Forgot your password?</a>
        </div>
    </form>
    <form action="/register" method="post" id="registerForm">
        @csrf
        <div class="overbox">
            <div class="material-button alt-2"><span class="shape"></span></div>
            <div class="title">REGISTER</div>
            <div class="input">
                <label for="regemail">Email</label>
                <input type="email" name="email" id="regemail" required class="@error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <span class="spin"></span>
            </div>
            <div class="input">
                <label for="regname">Username</label>
                <input type="text" name="username" id="regname" maxlength="12" required class="@error('username') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <span class="spin"></span>
            </div>
            <div class="input">
               <label for="regpass">Password</label>
               <input type="password" name="password" id="regpass" required class="@error('password') is-invalid @enderror">
               @error('password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
               <span class="spin"></span>
            </div>

            <div class="button">
               <button type="submit"><span>NEXT</span></button>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>