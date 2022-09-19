<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqCateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq_categories')->insert([
            'name' => 'Loans',
            'slug' => 'loan',
            // 'password' => Hash::make('password'),
        ]);

        DB::table('faq_categories')->insert([
            'name' => 'Membership',
            'slug' => 'membership',
            // 'password' => Hash::make('password'),
        ]);
    }
}
