<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::truncate();

        $Branches = [
            [
                'name_ar' => 'كوديز للحلول البرمجية',
                'name_en' => 'Codes For Programing Solutions',
                'location_ar' => 'مصر',
                'location_en' => 'Egypt',
                'mobile' => '01002208627',
                'email' => 'm.abdalmoamen@gmail.com',
                'vat' => 14,
                'vat_num' => 544554,
                'logo'=> 'data:image/jpeg;base64,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',

                'uuid' => Str::uuid()->toString()
            ],

        ];

        foreach ($Branches as $key => $value) {
            Branch::create($value);
        }
    }
}
