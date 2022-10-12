<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Users\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
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
            $sumcontribution = Transaction::where('customer_id', $user->id)->where('trx_type', 1)->sum('amount');
            $sumdebit = Transaction::where('customer_id', $user->id)->where('trx_type', 0)->sum('amount');

            $sum = $sumcontribution - $sumdebit;

            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->balance = $sum;
            $wallet->save();
        }
    }
}
