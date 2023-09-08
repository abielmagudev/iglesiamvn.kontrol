<?php

namespace Database\Seeders;

use App\Models\FamiliaMiembro;
use Illuminate\Database\Seeder;

class FamiliaMiembroSeeder extends Seeder
{
    public function run()
    {
        return FamiliaMiembro::factory(500)->create();
    }
}
