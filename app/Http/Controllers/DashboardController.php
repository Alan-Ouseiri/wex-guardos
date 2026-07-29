<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Loan;
use App\Models\Responsiva;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResponsivas = Responsiva::count('*');
        $responsivasActivas = Responsiva::query()->where('status', 'Activa')->count();
        $responsivasPapelera = Responsiva::onlyTrashed()->count();

        $totalUsuarios = Teacher::count('*');

        $totalDispositivos = Device::count('*');
        $dispositivosUsados = Device::query()->where('status', 'Asignado')->count();
        $dispositivosDisponibles = Device::query()->where('status', 'Disponible')->count();
        $dispositivosMantenimiento = Device::query()->where('status', 'Mantenimiento')->count();

        $activeLoans = Loan::with(['teacher', 'device'])
            ->where('status', 'active')
            ->orderBy('loan_date')
            ->get();

        $totalPrestamos = Loan::query()->where('status', 'active')->count();

        return view('dashboard', compact(
            'totalResponsivas',
            'responsivasActivas',
            'responsivasPapelera',
            'totalUsuarios',
            'totalDispositivos',
            'totalPrestamos',
            'dispositivosUsados',
            'dispositivosDisponibles',
            'dispositivosMantenimiento',
            'activeLoans'
        ));
    }
}
