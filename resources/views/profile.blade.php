@extends('layout.app')
@section('content')
    <style>
        body {
            background: #f4f6f9;
            font-family: "Segoe UI", sans-serif;
        }

        .profile-card {
            border-radius: 18px;
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(90deg, #0d6efd, #4dabf7);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .profile-header img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid white;
            margin-bottom: 10px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px;
        }

        .card {
            border-radius: 18px;
        }
    </style>
    <div class="container py-5">

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
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <!-- Profile Settings Card -->
        <div class="card shadow-sm border-0 profile-card">

            <!-- Header -->
            <div class="profile-header">
                <img src="https://i.ibb.co/4pDNDk1/avatar.png" alt="Profile">
                <h4 class="fw-bold mb-0">Profile Settings</h4>
                <p class="mb-0 small">Manage your account details</p>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                <h4>Profile Info</h4>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- name -->
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name"
                                    placeholder="Enter name" required>
                            </div>
                        </div>
                        <!-- Username -->
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}" id="username"
                                    placeholder="Enter username" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email"
                                    placeholder="Enter email" required>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                Save Changes
                            </button>
                        </div>

                    </div>

                </form>
                <h4>Update Password</h4>
                <form action="{{ route('profile.password') }}" method="post">
                    @csrf
                    <div class="row">

                        <!-- Current Password -->
                        <div class="col-md-6">
                            <label class="form-label">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" name="current_password"
                                    placeholder="Enter current password">
                            </div>
                        </div>
                        <!-- New Password -->
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Enter new password">
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm password">
                            </div>
                        </div>
                        <!-- Save Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-danger">
                                Save Password
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
