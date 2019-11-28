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
                'name' => 'Модератор Модератор',
                'email' => 'moderator@ex.com',
                'password' => Hash::make('moderator'),
                'role_id' => 1,
            ],
            [
                'name' => 'Клиент Клиент',
                'email' => 'client@ex.com',
                'password' => Hash::make('client'),
                'role_id' => 2,
            ],
        ]);
    }
}
