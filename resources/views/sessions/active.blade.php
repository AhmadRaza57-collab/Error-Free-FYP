@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 my-1">
                    <h4 class="card-title">
                        Active Sessions
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                    </tr>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->start_time }} to {{ $session->end_time }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
