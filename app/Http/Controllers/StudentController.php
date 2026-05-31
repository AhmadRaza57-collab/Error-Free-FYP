<?php

namespace App\Http\Controllers;

use App\Models\StdClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'std');
        $classes = StdClass::all();

        if (Auth::user()->role == 'teacher') {
            $students = $students->where('std_class_id', Auth::user()->std_class_id);
        }
        $students = $students->get();
        return view('students.list', compact('students','classes'));
    }
    public function create()
    {
        return view('students.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'is_active' => 'required|in:yes,no',
        ]);
        $class_id = Null;
        if (Auth::user()->role == 'teacher') {
            $class_id =  Auth::user()->std_class_id;
        }
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'std',
            'is_active' => $request->is_active,
            'std_class_id' => $class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('students.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'is_active' => 'required|in:yes,no',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = 'std';
        $user->is_active = $request->is_active;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
    public function assignClass(Request $request, $stdId)
    {
        $request->validate([
            'class' => 'nullable|exists:std_classes,id',
        ]);
        $student = User::findOrFail($stdId);
        $student->update([
            'std_class_id' => $request->class,
        ]);
        // dd($student);
        return to_route('students.index')->with('success', 'Class assign successfully.');
    }
}
