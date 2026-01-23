<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            [
                'type' => 'MacBook',
                'brand' => 'Apple',
                'model' => 'Air 11',
                'serial_number' => 'MB-A11-001',
                'status' => 'Disponible',
            ],
            [
                'type' => 'iPad',
                'brand' => 'Apple',
                'model' => '10th Gen',
                'serial_number' => 'IP-10-002',
                'status' => 'Disponible',
            ],
            [
                'type' => 'Proyector',
                'brand' => 'Epson',
                'model' => 'X200',
                'serial_number' => 'EP-X200-003',
                'status' => 'Disponible',
            ],
        ];

        foreach ($devices as $device) {
            Device::create($device);
        }
    }
}
