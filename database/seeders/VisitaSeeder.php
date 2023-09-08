<?php

namespace Database\Seeders;

use App\Models\Visita;
use Illuminate\Database\Seeder;

class VisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visita::factory(500)->create();
    }
}
