<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Admin\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $agent1 = User::find(3);
        $agent2 = User::find(2);
        //SEEDING TRANSACTIONS FOR ALL USERS UNDER TWO AGENTS - CONTRIBUTIONS
       foreach($users as $user){
            Transaction::factory()->count(4)->create([
                'customer_id'=>$user->id, 
                'agent_id'=>$agent1->id,
                'amount'=>6000,
                'trx_type'=>1,
                'purpose'=>"contribution"
            ]);
       }
       foreach($users as $user){
        Transaction::factory()->count(3)->create([
            'customer_id'=>$user->id, 
            'agent_id'=>$agent2,
            'amount'=>4500,
            'trx_type'=>1,
            'purpose'=>"contribution"
            ]);
        }


        //SEEDING WITHDRAWAL TRANSACTIONS
        foreach($users as $user){
            Transaction::factory()->count(3)->create([
                'customer_id'=>$user->id, 
                'agent_id'=>$agent2,
                'amount'=>1200,
                'trx_type'=>0,
                'purpose'=>"Contribution",
                'approved'=>1,
                'withdraw_type'=>'transfer'
            ]);
        }

        foreach($users as $user){
            Transaction::factory()->count(3)->create([
                'customer_id'=>$user->id, 
                'agent_id'=>$agent2,
                'amount'=>900,
                'trx_type'=>1,
                'purpose'=>"Contribution",
                'approved'=>1,
                'withdraw_type'=>'cash'
                ]);
        }
    }
}
