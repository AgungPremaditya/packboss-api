<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transport;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transport::create([
            'name' => 'Truck Box Mitsubishi',
            'license_number' => 'DK 1000 AL',
            'transport_type' => 'truck_box',
            'transport_code' => 'TRBX-DK1000AL',
            'status' => 1
        ]);
        
        Transport::create([
            'name' => 'Truck Hino Dutro',
            'license_number' => 'DK 2045 KLA',
            'transport_type' => 'truck',
            'transport_code' => 'TR-DK2045KLA',
            'status' => 1
        ]);

        Transport::create([
            'name' => 'Pick-up Suzuki',
            'license_number' => 'DK 1090 KP',
            'transport_type' => 'pick_up',
            'transport_code' => 'PU-DK1090KP',
            'status' => 1
        ]);
    }
}
