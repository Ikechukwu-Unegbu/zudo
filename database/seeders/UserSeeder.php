<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email'=>'superadmin@admin.com',
            'access'=>'admin'
        ]);

        User::factory()->create([
            'email'=>'channel@channel.com',
            'access'=>'channel'
        ]);

        User::factory()->create([
            'email'=>'user@user.com',
            'access'=>'user'
        ]);
    }
}
