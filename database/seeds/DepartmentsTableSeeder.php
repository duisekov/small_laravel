<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();

        DB::table('departments')->insert([
            ['name' => 'IT отдел'],
            ['name' => 'Финансовый отдел'],
            ['name' => 'Отдел продаж'],
        ]);
    }
}
