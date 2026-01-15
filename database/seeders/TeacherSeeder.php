<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Juan',
                'surname' => 'Pérez',
                'employee_number' => 'DOC001',
                'role' => 'Profesor',
                'email' => 'juan.perez@escuela.test',
            ],
            [
                'name' => 'María',
                'surname' => 'Gómez',
                'employee_number' => 'DOC002',
                'role' => 'Profesora',
                'email' => 'maria.gomez@escuela.test',
            ],
            [
                'name' => 'Carlos',
                'surname' => 'Ramírez',
                'employee_number' => 'DOC003',
                'role' => 'Administrativo',
                'email' => null,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
