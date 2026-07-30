<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Loan;
use App\Models\Responsiva;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResponsivas = Responsiva::count('*');
        $responsivasActivas = Responsiva::where('status', 'Activa')->count();
        $responsivasPapelera = Responsiva::onlyTrashed()->count();
        $totalUsuarios = Teacher::count('*');
        $totalDispositivos = Device::count('*');

        return view('dashboard', compact(
            'totalResponsivas',
            'responsivasActivas',
            'responsivasPapelera',
            'totalUsuarios',
            'totalDispositivos',
        ));
    }
}
