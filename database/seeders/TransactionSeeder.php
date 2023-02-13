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
        $agent1 = User::find(3);
        $agent2 = User::find(2);
        $users_agent_1 = User::where('channel_id', $agent1->id)->get();
        $users_agent_2 = User::where('channel_id', $agent2->id)->get();
      
        //SEEDING TRANSACTIONS FOR ALL USERS UNDER TWO AGENTS - CONTRIBUTIONS
       foreach($users_agent_1 as $user){
            Transaction::factory()->count(4)->create([
                'customer_id'=>$user->id, 
                'agent_id'=>$agent1->id,
                'amount'=>6000,
                'trx_type'=>1,
                'purpose'=>"contribution"
            ]);
            //add it to the user wallet

       }
       foreach($users_agent_1 as $user){
            Transaction::factory()->count(4)->create([
                'customer_id'=>$user->id, 
                'agent_id'=>$agent1->id,
                'amount'=>1200,
                'trx_type'=>0,
                'purpose'=>"contribution"
            ]);
            //add it to the user wallet

       }

       foreach($users_agent_2 as $user){
        Transaction::factory()->count(3)->create([
            'customer_id'=>$user->id, 
            'agent_id'=>$agent2->id,
            'amount'=>1000,
            'trx_type'=>0,
            'purpose'=>"contribution"
            ]);
        }

        foreach($users_agent_2 as $user){
            Transaction::factory()->count(3)->create([
                'customer_id'=>$user->id, 
                'agent_id'=>$agent2->id,
                'amount'=>4500,
                'trx_type'=>1,
                'purpose'=>"contribution"
                ]);
            }
       
    }
}
