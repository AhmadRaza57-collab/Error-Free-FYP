@extends('layout.app')
@section('content')
    <!-- Cards Section -->
    <div class="row g-4">
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Sessions</h6>
                    <h3 class="fw-bold">{{ $todaySessionsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Present</h6>
                    <h3 class="fw-bold">{{ $presentCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Apsent</h6>
                    <h3 class="fw-bold">{{ $apsentCount }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Table Section -->
    <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Today Sessions</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todaySessions as $todaySession)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $todaySession->title }}</td>
                                <td>{{ $todaySession->start_time }} to {{ $todaySession->end_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
