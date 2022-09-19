<?php

namespace Database\Seeders;

use App\Models\V1\Admin\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'sms'=>1,
            'e_debit'=>1,
            'e_credit'=>0,
            'user_data'=>0,
            'exclusive'=>0
        ]);
    }
}
