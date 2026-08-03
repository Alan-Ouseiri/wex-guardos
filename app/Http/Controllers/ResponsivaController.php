<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Responsiva;
use App\Models\ResponsivaHistory;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResponsivaController extends Controller
{
    public function index(Request $request)
    {
        $query = Responsiva::with(['teacher', 'device']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Folio
                $q->where('responsiva_number', 'like', "%{$search}%")

                    // Docente
                    ->orWhereHas('teacher', function ($q) use ($search) {
                        $q->where('surname', 'like', "%{$search}%");
                    })

                    // Serie del dispositivo
                    ->orWhereHas('device', function ($q) use ($search) {
                        $q->where('serial_number', 'like', "%{$search}%");
                    });
            });
        }

        $responsivas = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('responsivas.index', compact('responsivas'));
    }

    public function allActive()
    {
        $query = Responsiva::where('status', 'Activa')->get();

        foreach ($query as $key => $q) {
            $q->name = $q->teacher->name . ' ' . $q->teacher->surname;
            $q->description = $q->device->brand . ' ' . $q->device->type . ' ' . $q->device->model;
            $q->no = $q->device->serial_number;
            $q->button = view('responsivas.buttonSee', ['r' => $q->id])->render();
        }

        return $query;
    }

    public function all()
    {
        $query = Responsiva::get();

        foreach ($query as $key => $q) {
            $q->name = $q->teacher->name . ' ' . $q->teacher->surname;
            $q->description = $q->device->brand . ' ' . $q->device->type . ' ' . $q->device->model;
            $q->no = $q->device->serial_number;
            $q->button = view('responsivas.buttonSee', ['r' => $q->id])->render();
        }

        return $query;
    }

    public function allTrash()
    {
        $query = Responsiva::onlyTrashed()->get();

        foreach ($query as $key => $q) {
            $q->name = $q->teacher->name . ' ' . $q->teacher->surname;
            $q->description = $q->device->brand . ' ' . $q->device->type . ' ' . $q->device->model;
            $q->no = $q->device->serial_number;
            $q->button = view('responsivas.buttonTrash', ['r' => $q->id])->render();
            $q->fecha = $q->deleted_at->format('d/m/Y H:i');
        }

        return $query;
    }

    public function create()
    {
        $teachers = Teacher::query()->orderBy('name', 'asc')->get();
        $devices = Device::query()->where('status', 'Disponible')->get();

        return view('responsivas.create', compact('teachers', 'devices'));
    }

    public function store(Request $request)
    {
        $date = Carbon::parse($request->date);
        $year = $date->year;
        $month = $date->month;

        $lastResponsiva = Responsiva::withTrashed()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('responsiva_number', 'desc')
            ->first();

        $nextNumber = 1;

        if ($lastResponsiva) {
            $lastConsecutive = (int) substr($lastResponsiva->responsiva_number, -5);
            $nextNumber = $lastConsecutive + 1;
        }

        $responsivaNumber = (string)$year . str_pad((string)$month, 2, '0', STR_PAD_LEFT) . '-' .
            str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        $validated = $request->validate([
            'date' => 'required|date',
            'teacher_id' => 'required|exists:teachers,id',
            'device_id' => 'required|exists:devices,id',
            'condition' => 'required',
            'location' => 'required',
            'delivered_by' => 'required',
        ]);

        $device = Device::findOrFail($request->device_id);

        $responsiva = Responsiva::create([
            'responsiva_number' => $responsivaNumber,
            'verification_code' => $this->generateVerificationCode(),
            'assigned_date' => $request->date,
            'teacher_id' => $request->teacher_id,
            'device_id' => $device->id,
            'device_description' => $device->description,
            'serial_number' => $device->serial_number,
            'condition' => $request->condition,
            'location' => $request->location,
            'delivered_by' => $request->delivered_by,
            'status' => 'Activa',
            'user_id' => Auth::id(),
        ]);

        // Cambiar estado del dispositivo
        $device->update([
            'status' => 'Asignado'
        ]);

        ResponsivaHistory::create([
            'responsiva_id' => $responsiva->id,
            'action' => 'Asignada',
            'description' => 'Creación de la responsiva y asignacion del dispositivo',
            'action_date' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->route('responsivas.index')
            ->with('success', 'Responsiva creada correctamente');
    }

    public function pdf(Responsiva $responsiva)
    {
        $responsiva->load(['teacher', 'device']);

        $pdf = Pdf::loadView('responsivas.pdf', compact('responsiva'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream('Responsiva_' . $responsiva->folio . '.pdf');
    }

    public function active(Request $request)
    {
        $query = Responsiva::with(['teacher', 'device'])
            ->where('status', 'Activa');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Folio
                $q->where('responsiva_number', 'like', "%{$search}%")

                    // Docente
                    ->orWhereHas('teacher', function ($q) use ($search) {
                        $q->where('surname', 'like', "%{$search}%");
                    })

                    // Serie del dispositivo
                    ->orWhereHas('device', function ($q) use ($search) {
                        $q->where('serial_number', 'like', "%{$search}%");
                    });
            });
        }

        $responsivas = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('responsivas.active', compact('responsivas'));
    }

    public function returnDevice(Responsiva $responsiva)
    {
        date_default_timezone_set('America/Mexico_City');

        DB::transaction(function () use ($responsiva) {

            $responsiva->update([
                'status' => 'Regresado',
                'verification_code' => null,
                'returned_date' => date('Y-m-d H:i:s'),
            ]);

            $responsiva->device->update([
                'status' => 'Disponible',
            ]);

            $responsiva->histories()->create([
                'action' => 'Regresado',
                'description' => 'Dispositivo devuelto',
                'action_date' => date('Y-m-d H:i:s'),
            ]);
        });

        return redirect()
            ->route('responsivas.index')
            ->with('success', 'Dispositivo devuelto correctamente');
    }

    public function history(Responsiva $responsiva)
    {
        $histories = $responsiva->histories()
            ->orderBy('action_date', 'desc')
            ->get();

        return view('responsivas.history', compact('responsiva', 'histories'));
    }

    public function createFull()
    {
        $teachers = Teacher::query()->orderBy('name', 'asc')->get();
        $devices = Device::query()->where('status', 'Disponible')->get();
        return view('responsivas.create-full', compact('teachers', 'devices'));
    }

    public function storeFull(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $usingExistingTeacher = $request->filled('teacher_id');
        $usingExistingDevice = $request->filled('device_id');

        $request->validate([
            'teacher_id' => $usingExistingTeacher ? 'required|exists:teachers,id' : 'nullable',
            'teacher.name' => $usingExistingTeacher ? 'nullable' : 'required',
            'teacher.surname' => $usingExistingTeacher ? 'nullable' : 'required',
            'teacher.role' => $usingExistingTeacher ? 'nullable' : 'required',
            'teacher.email' => $usingExistingTeacher ? 'nullable' : 'required|email',
            'teacher.employee_number' => $usingExistingTeacher ? 'nullable' : 'max:50|unique:teachers,employee_number',

            'device_id' => $usingExistingDevice ? 'required|exists:devices,id' : 'nullable',
            'device.type' => $usingExistingDevice ? 'nullable' : 'required',
            'device.brand' => $usingExistingDevice ? 'nullable' : 'required',
            'device.model' => $usingExistingDevice ? 'nullable' : 'required',
            'device.serial_number' => $usingExistingDevice ? 'nullable' : 'required',

            'assigned_date' => 'required|date',
            'condition' => 'required',
            'location' => 'required',
            'delivered_by' => 'required',
        ]);

        DB::transaction(function () use ($request, $usingExistingTeacher, $usingExistingDevice) {

            $teacher = $usingExistingTeacher
                ? Teacher::findOrFail($request->teacher_id)
                : Teacher::create($request->teacher);

            $device = $usingExistingDevice
                ? Device::findOrFail($request->device_id)
                : Device::create([...$request->device, 'status' => 'Asignado']);

            $date = Carbon::parse($request->assigned_date);

            $year = $date->year;
            $month = $date->month;

            $lastResponsiva = Responsiva::withTrashed()
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('responsiva_number', 'desc')
                ->first();

            $nextNumber = 1;

            if ($lastResponsiva) {
                $lastConsecutive = (int) substr($lastResponsiva->responsiva_number, -5);
                $nextNumber = $lastConsecutive + 1;
            }

            $responsivaNumber = $year . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' .
                str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

            $imagePath = $request->hasFile('delivery_image')
                ? $request->file('delivery_image')->store('responsivas', 'public')
                : null;

            $responsiva = Responsiva::create([
                'responsiva_number' => $responsivaNumber,
                'verification_code' => $this->generateVerificationCode(),
                'teacher_id' => $teacher->id,
                'device_id' => $device->id,
                'assigned_date' => $request->assigned_date,
                'condition' => $request->condition,
                'location' => $request->location,
                'delivered_by' => $request->delivered_by,
                'notes' => $request->notes,
                'delivery_image' => $imagePath,
                'status' => 'Activa',
            ]);

            $responsiva->histories()->create([
                'action' => 'Asignada',
                'description' => 'Creación de la responsiva y asignación del dispositivo',
                'action_date' => date('Y-m-d H:i:s'),
            ]);
        });

        return redirect()
            ->route('responsivas.index')
            ->with('success', 'Responsiva creada correctamente');
    }

    private function generateVerificationCode(): string
    {
        return strtoupper(Str::random(8));
    }

    public function edit(Responsiva $responsiva)
    {
        return view('responsivas.edit', [
            'responsiva' => $responsiva,
            'teachers' => Teacher::all(),
            'devices' => Device::all(),
        ]);
    }

    public function update(Request $request, Responsiva $responsiva)
    {

        date_default_timezone_set('America/Mexico_City');

        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'device_id' => 'required|exists:devices,id',
            'description' => 'nullable|string|max:255',
        ]);

        $responsiva->update([
            'teacher_id' => $request->teacher_id,
            'device_id' => $request->device_id,
            'assigned_date' => $request->assigned_date,
            'description' => $request->description,
            'condition' => $request->condition,
            'location' => $request->location,
            'delivered_by' => $request->delivered_by,
        ]);

        ResponsivaHistory::create([
            'responsiva_id' => $responsiva->id,
            'action' => 'Edicion',
            'description' => 'La responsiva se edito',
            'action_date' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->route('responsivas.index')
            ->with('success', 'Responsiva actualizada correctamente');
    }

    public function show(Responsiva $responsiva)
    {
        $responsiva->load([
            'teacher',
            'device',
            'histories.user'
        ]);

        return view('responsivas.show', compact('responsiva'));
    }

    public function destroy(Request $request)
    {
        $responsiva = Responsiva::find($request->val);
        DB::transaction(function () use ($responsiva) {
            
            $h = ResponsivaHistory::create([
                'responsiva_id' => $responsiva->id,
                'action' => 'Eliminada',
                'description' => 'La responsiva fue enviada a la papelera',
                'action_date' => date('Y-m-d H:i:s'),
            ]);

            $r = Responsiva::where('id', $responsiva->id)->delete();
        });

        return view('responsivas.index')->with('success', 'Responsiva enviada a la papelera');
    }

    public function forceDelete($id)
    {
        $responsiva = Responsiva::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($responsiva) {
            $responsiva->histories()->create([
                'action' => 'Eliminada definitivamente',
                'description' => 'La responsiva fue eliminada permanentemente',
                'action_date' => date('Y-m-d H:i:s'),
            ]);

            $responsiva->forceDelete();
        });

        return back()->with('success', 'Responsiva eliminada definitivamente');
    }

    public function trash()
    {
        return view('responsivas.trash');
    }

    public function restore($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $responsiva = Responsiva::onlyTrashed()->findOrFail($id);

        $responsiva->restore();

        // Historial
        $responsiva->histories()->create([
            'action' => 'Restaurada',
            'description' => 'La responsiva fue restaurada desde la papelera',
            'action_date' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->route('responsivas.trash')
            ->with('success', 'Responsiva restaurada correctamente');
    }
}
