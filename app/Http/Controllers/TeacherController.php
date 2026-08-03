<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Responsiva;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $key => $t) {
            $active = Responsiva::select('id')->where('teacher_id', $t->id)->where('status', 'activa')->first();
            if ($active != '') {
                unset($teachers[$key]);
            }
        }

        return view('teachers.index', compact('teachers'));
    }

    public function all()
    {
        $query = Teacher::orderByDesc('created_at')->get();

        foreach ($query as $key => $q) {
            $q->user = $q->name . ' ' . $q->surname;

            $active = Responsiva::select('id')->where('teacher_id', $q->id)->where('status', 'activa')->first();
            if ($active == '') {
                $q->buttons = view('teachers.buttonDelete', ['user' => $q->id])->render();
            } else {
                $q->buttons = view('teachers.buttonEdit', ['user' => $q->id])->render();
            }
        }

        return $query;
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

        $teacher->forceDelete();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Docente eliminado correctamente');
    }
}
