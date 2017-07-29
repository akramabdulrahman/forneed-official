<?php

use Illuminate\Database\Seeder;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Users\SocialWorker::class, 100)->create()->each(function ($citizen) {
            $citizen->extras()->attach([rand() % (5 + 1 - 1) + 1,
                rand() % (11 + 1 - 6) + 6,
                rand() % (25 + 1 - 24) + 24,
            ]);
        });
    }
}
