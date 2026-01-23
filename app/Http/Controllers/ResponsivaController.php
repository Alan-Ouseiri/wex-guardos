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
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('surname', 'like', "%{$search}%");
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

    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        $devices = Device::where('status', 'Disponible')->get();

        return view('responsivas.create', compact('teachers', 'devices'));
    }

    public function store(Request $request)
    {
        $date = Carbon::parse($request->date);

        $year = $date->year;
        $month = $date->month;

        // Contar responsivas del mismo año y mes
        $count = Responsiva::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        // Consecutivo
        $consecutive = str_pad($count + 1, 5, '0', STR_PAD_LEFT);

        // Folio final
        $folio = $date->format('Ym') . '-' . $consecutive;


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
            'responsiva_number' => $folio,
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
        ]);

        // Cambiar estado del dispositivo
        $device->update([
            'status' => 'Asignado'
        ]);

        ResponsivaHistory::create([
            'responsiva_id' => $responsiva->id,
            'action' => 'Asignada',
            'description' => 'Creación de la responsiva y asignacion del dispositivo',
            'action_date' => Carbon::now(),
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
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('surname', 'like', "%{$search}%");
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

    public function returnDevice(Request $request, Responsiva $responsiva)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        if ($request->verification_code !== $responsiva->verification_code) {
            return back()->withErrors([
                'verification_code' => 'Código de verificación incorrecto'
            ]);
        }

        DB::transaction(function () use ($responsiva) {

            $responsiva->update([
                'status' => 'Regresado',
                'verification_code' => null,
                'returned_date' => now(),
            ]);

            $responsiva->device->update([
                'status' => 'Disponible',
            ]);

            $responsiva->histories()->create([
                'action' => 'Regresado',
                'description' => 'Dispositivo devuelto con código de verificación',
                'action_date' => now(),
            ]);
        });

        return redirect()
            ->route('responsivas.active')
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
        return view('responsivas.create-full');
    }

    public function storeFull(Request $request)
    {
        $request->validate([
            'teacher.name' => 'required',
            'teacher.surname' => 'required',
            'teacher.role' => 'required',
            'teacher.email' => 'required|email',

            'device.type' => 'required',
            'device.brand' => 'required',
            'device.model' => 'required',
            'device.serial_number' => 'required',

            'assigned_date' => 'required|date',
            'condition' => 'required',
            'location' => 'required',
            'delivered_by' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            // Crear docente
            $teacher = Teacher::create($request->teacher);

            // Crear dispositivo
            $device = Device::create([
                ...$request->device,
                'status' => 'Asignado'
            ]);

            // Generar número de responsiva
            $date = Carbon::parse($request->assigned_date);

            $count = Responsiva::whereYear('assigned_date', $date->year)
                ->whereMonth('assigned_date', $date->month)
                ->count();

            $responsivaNumber = $date->format('Ym') . '-' .
                str_pad($count + 1, 5, '0', STR_PAD_LEFT);

            // Subir imagen
            $imagePath = null;
            if ($request->hasFile('delivery_image')) {
                $imagePath = $request->file('delivery_image')
                    ->store('responsivas', 'public');
            }

            // Crear responsiva
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

            // Historial
            $responsiva->histories()->create([
                'action' => 'Asignada',
                'description' => 'Creación de la responsiva y asignacion del dispositivo',
                'action_date' => now(),
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
}
