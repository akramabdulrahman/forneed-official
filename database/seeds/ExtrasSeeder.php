<?php

use Illuminate\Database\Seeder;
use App\Models\Extra;
use App\Models\ExtraType;

class ExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            'AcademicLevel' => [
                'اقل من ثانوية عامة',
                'ثانوية عامة',
                'دبلوم',
                'بكالوريوس',
                'دراسات عليا',
            ],
            'Age' => [
                'اقل من 18',
                '18 – 25',
                '26 – 35',
                '36 – 45',
                '46 – 55',
                '56 فما فوق',
            ],
            'Company' => [
                'أمم متحدة',
                'منظمة دولية',
                'منظمة محلية',
                'منظمة ربحية',
                'منظمة حكومية',
                'شركة ناشئة',
                'مجموعة شبابية',
            ],
            'Disability' => [
                'بصرية',
                'سمعية',
                'حركية',
                'ذهنية',
                'بدون اعاقة',
            ],
            'Gender' => [
                'ذكر',
                'انثى'
            ],
            'MaritalState' => [
                'أعزب/آنسة',
                'متزوج/ة',
                'مطلق/ة',
                'أرمل/ة',
                'أخرى',
            ],
            'RefugeState' => [
                'لاجئ/ة',
                'غير لاجئ/ة'
            ],
            'WorkField' => [
                'قطاع الصحة',
                'قطاع التعليم',
                'قطاع المسكن',
                'قطاع الحماية',
                'قطاع المياه والنظافة',
                'قطاع الأمن الغذائي',
                'قطاع تكنولوجيا المعلومات والاتصالات',
                'قطاع ريادية الأعمال',
                'قطاع الخدمة المجتمعية والعمل الخيري',
                'قطاع الطوارئ والعمل الاغاثي',
            ],
            'WorkingState' => [
                'موظف/ة حكومي',
                'موظف/ة قطاع خاص',
                'موظف/ة قطاع أهلي',
                'طالب جامعي',
                'خريج/ لا يعمل',
                'مهنى / عامل',
                'عاطل عن العمل',
                'عمل مؤقت',
            ]
        ];

        collect($fields)->each(function ($category, $key) {
            $type = ExtraType::create(['name' => $key]);
            collect($category)->each(function ($item) use ($type) {
                Extra::create([
                    'name' => $type->name,
                    'extra' => $item,
                    'extra_type_id' => $type->id
                ]);
            });

        });
    }
}
