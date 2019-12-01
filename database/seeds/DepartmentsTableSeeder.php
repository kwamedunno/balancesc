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
        DB::table('departments')->insert([
            [
                'id' => "1",
                'description' => 'Technology',
                'default_measures' => null
            ],
            [
                'id' => "2",
                'description' => 'Sales',
                'default_measures' => null
            ]
        ]);
    }
}
