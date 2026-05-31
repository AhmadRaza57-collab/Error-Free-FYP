<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: "Segoe UI", sans-serif;
        }

        .login-card {
            background: #fff;
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
        }

        .icon-box {
            width: 75px;
            height: 75px;
            background: rgba(13, 110, 253, 0.12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            margin-bottom: 20px;
        }

        .icon-box i {
            font-size: 32px;
            color: #0d6efd;
        }

        h3 {
            font-weight: 700;
            text-align: center;
        }

        p {
            text-align: center;
            color: #6c757d;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-login {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            background: linear-gradient(90deg, #0d6efd, #4dabf7);
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        .extra-links {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .extra-links a {
            color: #0d6efd;
            font-weight: 600;
            text-decoration: none;
        }

        /* Responsive Padding Fix */
        @media (max-width: 576px) {
            .login-card {
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- Icon -->
        <div class="icon-box">
            <i class="bi bi-person-circle"></i>
        </div>

        <!-- Heading -->
        <h3>Welcome Back</h3>
        <p>Please login to continue</p>

        <!-- Alerts Section -->
        <div class="mb-4">
            @if (session('success'))
                <!-- Success Alert -->
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <!-- Danger Alert -->
                <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    <strong>Error!</strong> {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <!-- Login Form -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Username or Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input type="text" name="login" class="form-control" placeholder="Username or Email"
                        value="{{ old('login') }}" required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-primary w-100 btn-login">
                Login
            </button>

            <!-- Register Link -->
            <div class="extra-links">
                Don’t have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </div>

</body>

</html>
