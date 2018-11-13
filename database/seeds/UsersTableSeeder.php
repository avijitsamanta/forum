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
        $user1 = ['name'=>'admin',
            'password'=>bcrypt('admin'),
            'email'=>'avijit@mailinator.com',
            'admin'=>1,
            'avatar'=>asset('avatars/avatar.png')
        ];

        $user2 = ['name'=>'Avijit',
            'password'=>bcrypt('123456'),
            'email'=>'avijit1@mailinator.com',
            'admin'=>0,
            'avatar'=>asset('avatars/avatar.png')
        ];
        User::create($user1);
        User::create($user2);
    }
}
