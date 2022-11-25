<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Public\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $channel2 = User::where('access','channel')->first();
        // $channel1 = User::find(5);
        // foreach($users as $user){
        //     Request::factory()->count(3)->create([
        //         'amount'=>1400,
        //         'customer_id'=>$user->id, 
        //         'type'=>'cash',
        //         'approved'=>1,
        //         'staff_id'=>$channel1->id,
        //     ]);
        // }
        foreach($users as $user){
            Request::factory()->count(2)->create([
                'amount'=>1400,
                'customer_id'=>$user->id, 
                'type'=>'cash',
                'approved'=>1,
                'staff_id'=>$channel2->id,
            ]);
        }
    }
}
