<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::orderBy('created_at', 'desc')->get();
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
            'status' => 'required|in:available,assigned,maintenance,retired',
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
            'status' => 'required|in:available,assigned,maintenance,retired',
        ]);

        $device->update($validated);

        return redirect()
            ->route('devices.index')
            ->with('success', 'Dispositivo actualizado correctamente');
    }
}
