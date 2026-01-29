<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Nombre
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('surname', 'like', "%{$search}%")

                    // Email
                    ->orWhere('email', 'like', "%{$search}%")

                    // Número de empleado
                    ->orWhere('employee_number', 'like', "%{$search}%");
            });
        }

        $teachers = $query
            ->orderBy('employee_number')
            ->paginate(10)
            ->withQueryString();

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
            'employee_number' => 'max:50|unique:teachers,employee_number',
            'role' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        Teacher::create($validated);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Usuario registrado correctamente');
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
            'employee_number' => 'max:50|unique:teachers,employee_number,' . $teacher->id,
            'role' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $teacher->update($validated);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(Teacher $teacher)
    {
        $hasActiveResponsiva = $teacher->responsivas()
            ->where('status', 'active')
            ->exists();

        if ($hasActiveResponsiva) {
            return redirect()
                ->route('teachers.index')
                ->with('error', 'No se puede eliminar el docente porque tiene una responsiva activa');
        }

        $teacher->delete();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Docente eliminado correctamente');
    }
}
