@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 my-1">
                    <h4 class="card-title">
                        All Sessions
                    </h4>
                </div>
                @if (Auth::user()->role != 'std')
                    <div class="col-md-6 my-1 text-end">
                        <a href="{{ route('sessions.create') }}" class="btn btn-primary">Create New</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <form action="{{ route('sessions.index') }}" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search ..">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Time</th>
                        <th>Class</th>
                        <th>Attendance</th>
                    </tr>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->start_time }} to {{ $session->end_time }}</td>
                            <td>{{ $session?->class?->name }}</td>
                            <td>
                                @php
                                    $attendance = Auth::user()
                                        ->attendances()
                                        ->where('session_id', $session->id)
                                        ->first();
                                @endphp
                                @if (Auth::user()->role != 'std')
                                    <a href="{{ route('attendance.show', $session->id) }}" class="btn btn-warning">
                                        Attendance
                                    </a>
                                @else
                                    @php
                                        $attendance = Auth::user()
                                            ->attendances()
                                            ->where('session_id', $session->id)
                                            ->first();
                                    @endphp

                                    @if ($session->end_time > now())
                                        @if (!$attendance || $attendance->status == 'absent')
                                            <form action="{{ route('attendance.mark', $session->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-warning">Mark Attendance</button>
                                            </form>
                                        @elseif ($attendance->status == 'present')
                                            Marked (Present)
                                        @endif
                                    @else
                                        @if ($attendance && $attendance->status == 'present')
                                            Marked (Present)
                                        @else
                                            Marked (Absent)
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
