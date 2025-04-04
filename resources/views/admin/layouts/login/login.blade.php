<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #4c6ef5;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4c6ef5;
            background: white;
            box-shadow: 0 0 0 3px rgba(76, 110, 245, 0.1);
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #999;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn i {
            margin-right: 10px;
        }

        .btn-primary {
            background: #4c6ef5;
            color: white;
        }

        .btn-primary:hover {
            background: #4263eb;
        }

        .btn-google {
            background: #ffffff;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .btn-google:hover {
            background: #f8f9fa;
            border-color: #d0d0d0;
        }

        .btn-facebook {
            background: #ffffff;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .btn-facebook:hover {
            background: #f8f9fa;
            border-color: #d0d0d0;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            background: white;
            padding: 0 10px;
            color: #666;
            font-size: 14px;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #4c6ef5;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin: 0 10px;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .invalid-feedback {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            padding-left: 15px;
        }
    </style>

</head>

<body>
    <div class="login-container">
        <h1>Welcome Back!</h1>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.loginPost') }}">
            @csrf
            <div class="form-group">
                <input type="email" 
                       name="email" 
                       placeholder="Enter Email Address..." 
                       value="{{ old('email') }}" 
                       class="@error('email') is-invalid @enderror">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" 
                       name="password" 
                       placeholder="Password" 
                       class="@error('password') is-invalid @enderror">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
        
        <div class="divider">
            <span>or continue with</span>
        </div>
        
        <a href="{{ route('admin.login.google') }}" class="btn btn-google">
            <i class="fab fa-google"></i> Login with Google
        </a>
        
        <a href="{{ route('admin.login.facebook') }}" class="btn btn-facebook">
            <i class="fab fa-facebook-f"></i> Login with Facebook
        </a>

        <div class="links">
            <a href="{{ route('admin.register') }}">Create an Account</a>
            <span>•</span>
            <a href="{{ route('admin.login') }}">Forgot Password?</a>
        </div>
    </div>
</body>

</html>