<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = ['男性', '女性'];
        foreach ($genders as $gender) {
            Gender::create(['gender' => $gender]);
        }
    }
}
