<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('roles'))->each(function ($role) {
             \App\Models\Users\Role::create(['name' => $role]);
        });
    }
}
