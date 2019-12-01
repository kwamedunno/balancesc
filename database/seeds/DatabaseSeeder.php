<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(ObjectivesTableSeeder::class);
        $this->call(MeasuresTableSeeder::class);
        $this->call(MetricsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(StaffTableSeeder::class);
    }
}
