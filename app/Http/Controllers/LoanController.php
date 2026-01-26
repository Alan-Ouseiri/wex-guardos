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
    public function index()
    {
        $loans = Loan::with(['teacher', 'device'])
            ->orderBy('loan_date', 'desc')
            ->get();

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
