<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $Useres = [
            ['name' => 'مصطفى', 'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'), 'branch_id'=>1,'status'=>0],

        ];

        foreach ($Useres as $key => $value) {
            User::create($value);
        }
    }
}
