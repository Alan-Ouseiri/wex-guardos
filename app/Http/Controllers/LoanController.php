<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Loan;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['teacher', 'device']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Buscar por docente
                $q->whereHas('teacher', function ($teacher) use ($search) {
                    $teacher->where('name', 'like', "%{$search}%")
                        ->orWhere('surname', 'like', "%{$search}%");
                })

                    // Buscar por dispositivo
                    ->orWhereHas('device', function ($device) use ($search) {
                        $device->where('serial_number', 'like', "%{$search}%");
                    });
            });
        }

        $loans = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create', [
            'teachers' => Teacher::orderBy('surname')->get(),
            'devices' => Device::where('status', 'Disponible')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'device_id' => 'required|exists:devices,id',
            'location' => 'required',
            'loan_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            Loan::create([
                'teacher_id' => $request->teacher_id,
                'device_id' => $request->device_id,
                'location' => $request->location,
                'loan_date' => $request->loan_date,
                'notes' => $request->notes,
                'status' => 'active',
            ]);

            Device::where('id', $request->device_id)
                ->update(['status' => 'Asignado']);
        });

        return redirect()
            ->route('loans.index')
            ->with('success', 'Préstamo registrado correctamente');
    }

    public function return(Loan $loan)
    {
        DB::transaction(function () use ($loan) {

            $loan->update([
                'status' => 'returned',
                'return_date' => now(),
            ]);

            $loan->device->update([
                'status' => 'Disponible',
            ]);
        });

        return back()->with('success', 'Dispositivo devuelto');
    }
}
