<?php

namespace App\Http\Controllers;


use App\Models\SessionModel;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function show($sessionId)
    {
        $attendances = Attendance::where('session_id', $sessionId)->get();
        return view('attendance.show', compact('attendances'));
    }
    public function mark(SessionModel $session)
    {
        $user = auth()->user();
        $now  = now();

        // class check
        if ($user->std_class_id !== $session->std_class_id) {
            abort(403);
        }

        // time check
        // if ($now->lt($session->start_time) || $now->gt($session->end_time)) {
        //     return back()->with('error', 'Attendance time expired.');
        // }
        if ($now >$session->end_time) {
            return back()->with('error', 'Attendance time expired.');
        }

        Attendance::firstOrCreate([
            'user_id' => $user->id,
            'session_id' => $session->id
        ], [
            'status' => 'present'
        ]);

        return back()->with('success', 'Attendance marked.');
    }
}
