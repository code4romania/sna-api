<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'name' => 'Alex Costea',
                'email' =>  'costeaalex@yahoo.com',
                'password' => '$2y$10$AnTQjLxN.iF0G7BNzE5.J.jcLgMUGmZ9kIRDDPTj5Cj1PyWmT8h3u'
        ]);
        User::create([
                'name' => 'Cata Tudorache',
                'email' =>  'tudorache.catalin47@gmail.com',
                'password' => '$2y$10$u1S4Zsu5FLDE20yFJ2ET0O5QEQc6U5vvMAFqpFmsxo3o4TYcPAbAi'
        ]);
    }
}
