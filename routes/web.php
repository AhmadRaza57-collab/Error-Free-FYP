<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StdClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/assign-class/{teacherId}', [TeacherController::class, 'assignClass'])->name('teachers-assignClass');
    Route::resource('students', StudentController::class);
    Route::post('/assign-class-to-student/{stdId}', [StudentController::class, 'assignClass'])->name('students-assignClass');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post("/profile/update", [ProfileController::class, "updateProfile"])->name("profile.update");
    Route::post("/profile/password", [ProfileController::class, "updatePassword"])->name("profile.password");

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
    Route::resource('users', UserController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('classes', StdClassController::class);

    Route::resource('sessions', SessionController::class)->only(['index', 'create', 'store']);
    Route::get('/active-sessions', [SessionController::class, 'activeSessions'])->name('active.sessions');
    Route::get('/attendance-detail/{sessionId}', [AttendanceController::class, 'show'])->name('attendance.show');

    Route::post('/attendance/mark/{session}', [AttendanceController::class, 'mark'])->name('attendance.mark');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
