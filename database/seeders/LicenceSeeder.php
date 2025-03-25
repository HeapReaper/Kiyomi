<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\Licence;

class LicenceSeeder extends Seeder
{
    public function run(): void
    {
        Licence::create(['name' => 'RC motorplane']);
        Licence::create(['name' => 'RC helicopter']);
        Licence::create(['name' => 'RC glider']);
        Licence::create(['name' => 'RC multicopter']);
        Licence::create(['name' => 'Drone A1']);
        Licence::create(['name' => 'Drone A2']);
        Licence::create(['name' => 'Drone A3']);
    }
}
