<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ExtrasSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(RolesSeeder::class);

    }
}
