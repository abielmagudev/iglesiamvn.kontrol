<?php

namespace Database\Seeders;

use App\Models\Ministerio;
use Illuminate\Database\Seeder;

class MinisterioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Ministerio::factory(10)->create();
    }
}
