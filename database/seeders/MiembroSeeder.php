<?php

namespace Database\Seeders;

use App\Models\Miembro;
use Illuminate\Database\Seeder;

class MiembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Miembro::factory(750)->create();
    }
}
