<?php

namespace Database\Seeders;

use App\Models\V1\Admin\Faq;
use App\Models\V1\Admin\FaqCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cates = Faq::all();

        foreach($cates as $cate){
            Faq::factory(3)->create([
                'category_id'=>$cate->id
            ]);
        }
    }
}
