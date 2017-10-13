<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Citizen;

class CitizensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Citizen::class, 100)->create()->each(function ($citizen) {
            $citizen->extras()->attach([rand() % (5 + 1 - 1) + 1,
                rand() % (11 + 1 - 6) + 6,
                rand() % (18 + 1 - 12) + 12,
                rand() % (23 + 1 - 19) + 19,
                rand() % (25 + 1 - 24) + 24,
                rand() % (30 + 1 - 26) + 26,
                rand() % (32 + 1 - 31) + 31,
                rand() % (42 + 1 - 33) + 33,
                rand() % (50 + 1 - 43) + 43,
                rand() % (55 + 1 - 51) + 51,
            ]);
        });

    }
}
