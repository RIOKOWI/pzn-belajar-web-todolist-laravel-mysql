<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'rio achyar';
        $user->email = 'rio@gmail.com';
        $user->password = Hash::make('rio');
        // $user->password = bcrypt('rio');
        $user->save();
    }
}
