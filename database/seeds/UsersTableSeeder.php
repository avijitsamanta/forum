<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([

        	'name'=>'admin',
        	'password'=>bcrypt('admin'),
        	'email'=>'avijit@mailinator.com',
        	'admin'=>1,
        	'avatar'=>asset('avatars/avatar.svg')

        ]);
    }
}
