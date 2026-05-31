<?php

namespace App\Http\Controllers;

use App\Models\StdClass;
use Illuminate\Http\Request;

class StdClassController extends Controller
{
    public function index()
    {
        $classes = StdClass::all();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        StdClass::create($request->all());
        return to_route('classes.index')->with('success', 'Class created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StdClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StdClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update($request->all());
        return to_route('classes.index')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StdClass $class)
    {
        $class->delete();
        return to_route('classes.index')->with('success', 'Class deleted successfully.');
    }
}
