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
        	'name' => 'Jose Alejandro',
        	'email' => 'jose.gutierrez@gmail.com',
        	'password' => bcrypt('0123'),
            'admin' => true
        ]);
    }
}
