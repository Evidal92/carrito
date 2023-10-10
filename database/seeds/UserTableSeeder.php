<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        User::create([

            'name' => "Emmanuel Vidal",
            'email' => "admin@test.com",
            'password' => bcrypt("123456"),
            'admin' => true
        ]);
    }
}
