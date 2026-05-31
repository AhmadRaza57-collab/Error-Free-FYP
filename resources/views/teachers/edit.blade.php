@extends('layout.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 my-1">
                    <h4>Edit Teacher</h4>
                </div>
                <div class="col-md-6 my-1 text-end">
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('teachers.update',$user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $user->name) }}"
                        required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username"
                        value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Is Active</label>
                    <select name="is_active" class="form-select" required>
                        <option value="">Select</option>
                        <option value="yes" @selected($user->is_active == 'yes')>Yes</option>
                        <option value="no" @selected($user->is_active == 'no')>No</option>
                    </select>
                    @error('is_active')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Password"
                        value="{{ old('password') }}">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Confirmation</label>
                    <input type="text" name="password_confirmation" class="form-control"
                        placeholder="Password Confirmation" value="{{ old('password_confirmation') }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
