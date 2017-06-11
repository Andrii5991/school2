<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'role' => 1,
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
            // 'name' => str_random(10),
            // 'role' => rand(0, 1),
            // 'email' => str_random(10).'@gmail.com',
            // 'password' => bcrypt('secret'),
        ]);
    }
}
