<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'first_name' => 'User1 firstname',
            'last_name' => 'User1 lastname',
            'email' => 'user1@email.com',
            'password' => bcrypt('password'),
        ]);
       \DB::table('users')->insert([
            'first_name' => 'User2 firstname',
            'last_name' => 'User2 lastname',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
        ]);
        \DB::table('users')->insert([
            'first_name' => 'User3 firstname',
            'last_name' => 'User3 lastname',
            'email' => 'user3@email.com',
            'password' => bcrypt('password'),
        ]);
        \DB::table('users')->insert([
            'first_name' => 'User4 firstname',
            'last_name' => 'User4 lastname',
            'email' => 'user4@email.com',
            'password' => bcrypt('password'),
        ]);
        \DB::table('users')->insert([
            'first_name' => 'User5 firstname',
            'last_name' => 'User5 lastname',
            'email' => 'user5@email.com',
            'password' => bcrypt('password'),
        ]);
    }
}
