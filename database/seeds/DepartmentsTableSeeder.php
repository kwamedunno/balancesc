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
            ],
            [
                'id' => "3",
                'description' => 'Operations',
                'default_measures' => null
            ],
            [
                'id' => "4",
                'description' => 'Service Delivery',
                'default_measures' => null
            ],
            [
                'id' => "5",
                'description' => 'Audit',
                'default_measures' => null
            ],
            [
                'id' => "6",
                'description' => 'Human Resource',
                'default_measures' => null
            ],
            [
                'id' => "7",
                'description' => 'Finance',
                'default_measures' => null
            ],
            [
                'id' => "8",
                'description' => 'TPU',
                'default_measures' => null
            ],
            [
                'id' => "9",
                'description' => 'Compliance',
                'default_measures' => null
            ],
            [
                'id' => "10",
                'description' => 'Governance',
                'default_measures' => null
            ],
            [
                'id' => "11",
                'description' => 'Management',
                'default_measures' => null
            ]
        ]);
    }
}
