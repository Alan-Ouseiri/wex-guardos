<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('surname')->get();
        return view('teachers.index', compact('teachers'));
    }

    public function new()
    {
        return view('teachers.create');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'employee_number' => 'required|string|max:50|unique:teachers,employee_number',
            'email' => 'nullable|email|max:255',
        ]);

        Teacher::create($validated);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Maestro registrado correctamente');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'employee_number' => 'required|string|max:50|unique:teachers,employee_number,' . $teacher->id,
            'email' => 'nullable|email|max:255',
        ]);

        $teacher->update($validated);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Maestro actualizado correctamente');
    }
}
