<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            ['شمال غزة', 31.524569582134685, 34.488039977539074],
            ['غزة', 31.499983427042807, 34.452334411132824],
            ['الوسطى', 31.427943925372475, 34.37886334179689],
            ['خانيونس', 31.347639601139402, 34.30333233593751],
            ['رفح', 31.30583514820843 , 34.25193786621094],
        ];

        foreach ($areas as $area) {
            \App\Models\Location\Area::create([
                'name' => $area[0],
                'lat' => $area[1],
                'lng' => $area[2],
            ]);
        }
    }
}
