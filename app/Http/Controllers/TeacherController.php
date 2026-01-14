<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
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
            ->route('dashboard')
            ->with('success', 'Maestro registrado correctamente');
    }
}
