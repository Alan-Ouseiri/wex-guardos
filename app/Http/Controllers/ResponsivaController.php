<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Responsiva;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResponsivaController extends Controller
{
    public function index()
    {
        $responsivas = Responsiva::with(['teacher', 'device'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('responsivas.index', compact('responsivas'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('surname')->get();
        $devices = Device::where('status', 'available')->get();

        return view('responsivas.create', compact('teachers', 'devices'));
    }

    public function store(Request $request)
    {
        $date = Carbon::parse($request->date);

        $year = $date->year;
        $month = $date->month;

        // Contar responsivas del mismo año y mes
        $count = Responsiva::whereYear('created_by', $year)
            ->whereMonth('created_by', $month)
            ->count();

        // Consecutivo
        $consecutive = str_pad($count + 1, 5, '0', STR_PAD_LEFT);

        // Folio final
        $folio = $date->format('Ym') . '-' . $consecutive;


        $validated = $request->validate([
            'date' => 'required|date',
            'teacher_id' => 'required|exists:teachers,id',
            'device_id' => 'required|exists:devices,id',
        ]);

        $device = Device::findOrFail($request->device_id);

        $responsiva = Responsiva::create([
            'responsiva_number' => $folio,
            'assigned_date' => $request->date,
            'teacher_id' => $request->teacher_id,
            'device_id' => $device->id,
            'device_description' => $device->description,
            'serial_number' => $device->serial_number,
            'status' => 'active',
        ]);

        // Cambiar estado del dispositivo
        $device->update([
            'status' => 'assigned'
        ]);

        return redirect()
            ->route('responsivas.index')
            ->with('success', 'Responsiva creada correctamente');
    }
}
