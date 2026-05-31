<?php

namespace App\Http\Controllers;

use App\Models\StdClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        $classes = StdClass::all();
        return view('teachers.list', compact('teachers', 'classes'));
    }
    public function create()
    {
        return view('teachers.create');
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

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('teachers.edit', compact('user'));
    }

    // Update user
    public function update(Request $request,  $id)
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
        $user->is_active = $request->is_active;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
    public function assignClass(Request $request, $teacherId)
    {
        $request->validate([
            'class' => 'nullable|exists:std_classes,id',
        ]);
        $teacher = User::findOrFail($teacherId);

        $teacher->update([
            'std_class_id' => $request->class,
        ]);
        return to_route('teachers.index')->with('success', 'Class assign successfully.');
    }
}
