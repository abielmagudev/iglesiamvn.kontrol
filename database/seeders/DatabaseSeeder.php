<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            MiembroSeeder::class,
            FamiliaMiembroSeeder::class,
            MinisterioSeeder::class,
            EventoSeeder::class,
            VisitaSeeder::class,
            UserSeeder::class,
        ];

        if( app()->environment(['production']) )
        {
            $seeders = [
                UserSeeder::class,
            ];
        }

        $this->call($seeders);
    }
}
