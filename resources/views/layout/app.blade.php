<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahmad-Taiyyab-FYP-2026-main</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <!-- Overlay for mobile -->
    <div id="overlay"></div>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="brand">{{ ucfirst(Auth::user()->role) }} Panel</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active-link' : '' }}"><i
                class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active-link' : '' }}"><i
                    class="bi bi-people-fill"></i> <span>Users</span></a>
            <a href="{{ route('teachers.index') }}"
                class="{{ request()->routeIs('teachers.*') ? 'active-link' : '' }}"><i
                    class="bi bi-bar-chart-fill"></i> <span>Teachers</span></a>
            <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*') ? 'active-link' : '' }}"><i
                    class="bi bi-bar-chart-fill"></i> <span>Classes</span></a>
        @endif
        @if (Auth::user()->role != 'std')
            <a href="{{ route('students.index') }}"
                class="{{ request()->routeIs('students.*') ? 'active-link' : '' }}"><i
                    class="bi bi-bar-chart-fill"></i>
                <span>Students</span></a>

            <a href="{{ route('active.sessions') }}"
                class="{{ request()->routeIs('active.sessions') ? 'active-link' : '' }}"><i
                    class="bi bi-bar-chart-fill"></i> <span>Active Sessions</span></a>
        @endif
        <a href="{{ route('sessions.index') }}" class="{{ request()->routeIs('sessions.*') ? 'active-link' : '' }}"><i
                class="bi bi-bar-chart-fill"></i> <span>Sessions</span></a>
        <form method="POST" action="{{ route('logout') }}" class="ms-4">
            @csrf

            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>


    </div>

    <!-- Main Content -->
    <div id="content">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg bg-white shadow-sm rounded-4 px-3 mb-4">
            <button class="btn btn-dark" id="toggleBtn"><i class="bi bi-list"></i></button>
            <span class="ms-3 fw-bold fs-5">{{ ucfirst(Auth::user()->role) }} Dashboard</span>


            <!-- Profile Icon -->
            <div class="ms-auto d-none d-md-flex">
                <a href="{{ route('profile') }}"><i class="bi bi-person-circle fs-3 text-primary"></i></a>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
