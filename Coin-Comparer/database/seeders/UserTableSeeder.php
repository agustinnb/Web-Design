<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        //
        $user = new User();
        $user->name=Str::random(10);
        $user->email=Str::random(10)."@gmail.com";
        $user->password=Hash::make('password');
        */
        User::factory()
        ->count(50)
        ->create();
    }
}
