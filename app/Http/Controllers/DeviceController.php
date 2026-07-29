<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $query = Device::query();

        if ($request->filled('search')) {
            $query->where('serial_number', 'like', '%' . $request->search . '%');
        }

        $devices = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('devices.index', compact('devices'));
    }

    public function new()
    {
        return view(view: 'devices.create');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'serial_number' => 'required|string|max:100|unique:devices,serial_number',
            'status' => 'required|in:Disponible,Asignado,Mantenimiento,Retirado',
        ]);

        Device::create($validated);

        return redirect()
            ->route('devices.index')
            ->with('success', 'Dispositivo registrado correctamente');
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'serial_number' => 'required|string|max:100|unique:devices,serial_number,' . $device->id,
            'status' => 'required|in:Disponible,Asignado,Mantenimiento,Retirado',
        ]);

        $device->update($validated);

        return redirect()
            ->route('devices.index')
            ->with('success', 'Dispositivo actualizado correctamente');
    }

    public function destroy(Device $device)
    {
        $hasActiveResponsiva = $device->responsivas()
            ->where('status', 'active')
            ->exists();

        if ($hasActiveResponsiva) {
            return redirect()
                ->route('devices.index')
                ->with('error', 'No se puede eliminar el dispositivo porque tiene una responsiva activa');
        }

        $device->query()->delete();

        return redirect()
            ->route('devices.index')
            ->with('success', 'Dispositivo eliminado correctamente');
    }
}
