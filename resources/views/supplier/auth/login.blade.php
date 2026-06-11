<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Login</title>
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            width: 800px;
            max-width: 90%;
            overflow: hidden;
            padding: 40px;
        }
        .login-left {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px solid #eee;
        }
        .login-left img {
            max-width: 80%;
            border-radius: 50%;
        }
        .login-right {
            width: 60%;
            padding-left: 40px;
        }
        .login-title {
            color: #e83e8c; /* Pink color matching design */
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .login-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .form-control {
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #e83e8c;
            box-shadow: 0 0 0 0.2rem rgba(232, 62, 140, 0.25);
        }
        .btn-pink {
            background-color: #e83e8c;
            color: #fff;
            border: none;
            padding: 10px 30px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-pink:hover {
            background-color: #d82e7c;
        }
        .links {
            display: inline-block;
            margin-left: 20px;
        }
        .links a {
            color: #e83e8c;
            text-decoration: none;
            margin-right: 15px;
            font-size: 14px;
            font-weight: 500;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-left">
        <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="User">
    </div>
    <div class="login-right">
        <div class="login-title">SRDC India Pvt Ltd</div>
        <div class="login-subtitle">Welcome back! Log in to your account.</div>
        
        @if ($errors->any())
            <div class="alert alert-danger" style="padding: 10px; border-radius: 8px; margin-bottom: 20px; color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('supplier.login.store') }}" method="POST">
            @csrf
            <div>
                <label style="display:block; margin-bottom:8px; color:#333;">Email address/Username</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div>
                <label style="display:block; margin-bottom:8px; color:#333;">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div style="display: flex; align-items: center; margin-top: 10px;">
                <button type="submit" class="btn-pink">Login</button>
                <div class="links">
                    <a href="#">Forgot Your Password?</a>
                    <a href="{{ route('supplier.register') }}">Vendor Register</a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
