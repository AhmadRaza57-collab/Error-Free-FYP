<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SessionModel;
use App\Models\ClassModel;
use App\Models\StdClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function activeSessions()
    {
        $user = Auth::user();
        $now = Carbon::now();

        $sessions = SessionModel::query();

        if ($user->role != 'admin') {
            $sessions = $sessions->where('std_class_id', $user->std_class_id);
        }

        $sessions = $sessions->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)->get();

        return view('sessions.active', compact('sessions'));
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $sessions = SessionModel::query();
        if ($user->role != 'admin') {
            $sessions = $sessions->where('std_class_id', $user->std_class_id);
        }
        if ($request->search) {
            $sessions = $sessions->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $sessions = $sessions->get();

        // mark apsent if any sessions end
        $finishedSessions = SessionModel::where('end_time', '<', now())->get();

        foreach ($finishedSessions as $session) {
            $students = User::where('role', 'std')
                ->where('std_class_id', $session->std_class_id)
                ->get();

            foreach ($students as $student) {
                $attendance = Attendance::where('user_id', $student->id)
                    ->where('session_id', $session->id)
                    ->first();

                if (!$attendance) {
                    Attendance::create([
                        'user_id' => $student->id,
                        'session_id' => $session->id,
                        'status' => 'absent',
                    ]);
                }
            }
        }

        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        $classes = StdClass::all();
        return view('sessions.create', compact('classes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:std_classes,id',
            'title'      => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        $exists = SessionModel::where('std_class_id', $request->class_id)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'time' => 'A session already exists for this class during this time.'
            ])->withInput();
        }

        SessionModel::create([
            'std_class_id' => $request->class_id,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return to_route('sessions.index')->with('success', 'Session created successfully');
    }
}
