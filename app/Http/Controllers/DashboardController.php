<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SessionModel;
use App\Models\StdClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = User::where('role', 'std')->count();
        $teachersCount = User::where('role', 'teacher')->count();
        $adminsCount = User::where('role', 'admin')->count();
        $classesCount = StdClass::count();
        $students = User::where('role', 'std')->latest()->limit(10)->get();

        $user = Auth::user();
        $now = Carbon::now();

        if ($user->role == 'admin') {
            return view('adminDashboard', compact('adminsCount', 'students', 'teachersCount', 'studentsCount', 'classesCount'));
        }
        if ($user->role == 'teacher') {
            $teacherStudents = $students->where('std_class_id', $user->std_class_id);
            $teacherStudentsCount = $students->where('std_class_id', $user->std_class_id)->count();


            $todaySessions = SessionModel::where('std_class_id', $user->std_class_id)->where('start_time', '<=', $now->today())
                ->where('end_time', '>=', $now)->get();
            $todaySessionsCount = $todaySessions->count();
            $todaySessionsAttendanceCount = Attendance::whereIn('session_id', $todaySessions->pluck('id'))->count();
            return view('teacherDashboard', compact('todaySessionsCount', 'teacherStudents', 'todaySessionsAttendanceCount', 'teacherStudentsCount'));
        }

        if (Auth::user()->role == 'std') {
            $todaySessions = SessionModel::where('std_class_id', $user->std_class_id)->where('start_time', '<=', $now->today())
                ->where('end_time', '>=', $now)->get();
            $todaySessionsCount = $todaySessions->count();

            $presentCount = Attendance::where('user_id', $user->id)
                ->whereIn('session_id', $todaySessions->pluck('id'))
                ->where('status', 'present')
                ->count();
            $apsentCount = Attendance::where('user_id', $user->id)
                ->whereIn('session_id', $todaySessions->pluck('id'))
                ->where('status', 'absent')
                ->count();


            return view('stdDashboard', compact('todaySessionsCount', 'presentCount', 'apsentCount', 'todaySessions'));
        }
    }
}
