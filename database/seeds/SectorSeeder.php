<?php

use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sectors = [
            'قطاع الصحة',
            'قطاع التعليم',
            'قطاع المسكن',
            'قطاع الحماية',
            'قطاع المياه والنظافة WASH',
            'قطاع الأمن الغذائي',
            'قطاع تكنولوجيا المعلومات والاتصالات',
            'قطاع ريادة الأعمال'
        ];

        foreach ($sectors as $sector) {
            \App\Models\Sector::create(['name' => $sector]);
        }
    }
}
