<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Users\Bankaccount;
use App\Models\V1\Users\Bankaccount as UsersBankaccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankaccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach($users as $user){
            UsersBankaccount::factory()->count(2)->create([
                'user_id'=>$user->id,
                // 'bank_name'=>$this->
            ]);
        }
    }
}
