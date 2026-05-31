<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #198754, #20c997);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: "Segoe UI", sans-serif;
        }

        .register-card {
            background: #fff;
            width: 100%;
            max-width: 500px;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
        }

        .icon-box {
            width: 75px;
            height: 75px;
            background: rgba(25, 135, 84, 0.12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            margin-bottom: 20px;
        }

        .icon-box i {
            font-size: 32px;
            color: #198754;
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

        .btn-register {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            background: linear-gradient(90deg, #198754, #20c997);
            border: none;
            transition: 0.3s;
        }

        .btn-register:hover {
            opacity: 0.9;
        }

        .extra-links {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .extra-links a {
            color: #198754;
            font-weight: 600;
            text-decoration: none;
        }

        /* Responsive Padding Fix */
        @media (max-width: 576px) {
            .register-card {
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="register-card">

        <!-- Icon -->
        <div class="icon-box">
            <i class="bi bi-person-plus-fill"></i>
        </div>

        <!-- Heading -->
        <h3>Create Account</h3>
        <p>Sign up to continue</p>
        <!-- Alerts Section -->
        <div class="mb-4">
            @if (session('success'))
                <!-- Success Alert -->
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <!-- Danger Alert -->
                <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    <strong>Error!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <!-- Form -->
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <!-- Full Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="Enter full name" required>
                </div>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Enter email" required>
                </div>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                        placeholder="Enter email" required>
                </div>
                @error('username')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                    <select class="form-select" name="role" id="role" required>
                        <option value="">Select role</option>
                        {{-- <option value="admin">Admin</option> --}}
                        <option value="teacher">Teacher</option>
                        <option value="std">Student</option>
                    </select>
                </div>
                @error('role')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Create password" required>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-shield-lock-fill"></i>
                    </span>
                    <input type="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Confirm password" required>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn btn-success w-100 btn-register">
                Register
            </button>

            <!-- Login Link -->
            <div class="extra-links">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

        </form>

    </div>

</body>

</html>
