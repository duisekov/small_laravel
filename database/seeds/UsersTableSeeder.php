<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name' => 'Модератор',
                'email' => 'moderator@ex.com',
                'password' => Hash::make('moderator'),
                'role_id' => 1,
            ],
            [
                'name' => 'Клиент 1',
                'email' => 'client1@ex.com',
                'password' => Hash::make('client1'),
                'role_id' => 2,
            ],
            [
                'name' => 'Клиент 2',
                'email' => 'client2@ex.com',
                'password' => Hash::make('client2'),
                'role_id' => 2,
            ],
        ]);
    }
}
