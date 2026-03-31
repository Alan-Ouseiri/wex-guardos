<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'cultura.digital@colegiowexford.edu.mx'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'ruben.rodriguez@wexford.edu.mx'],
            [
                'name' => 'Ruben',
                'password' => Hash::make('ruben123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'martin.arreola@wexford.edu.mx'],
            [
                'name' => 'Martin',
                'password' => Hash::make('martin123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'josafat.lopez@wexford.edu.mx'],
            [
                'name' => 'Angel',
                'password' => Hash::make('angel123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'alberto.pimentel@wexford.edu.mx'],
            [
                'name' => 'Alberto',
                'password' => Hash::make('albertos123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'alan.morales@wexford.edu.mx'],
            [
                'name' => 'Alan',
                'password' => Hash::make('alan123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'joel.juarez@wexford.edu.mx'],
            [
                'name' => 'Joel',
                'password' => Hash::make('joel123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'jorge.rangel@wexford.edu.mx'],
            [
                'name' => 'Jorge',
                'password' => Hash::make('jorge123'),
            ]
        );
    }
}
