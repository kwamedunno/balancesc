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
        $this->call(ScoreCardObjectivesTableSeeder::class);
        $this->call(ScoreCardMeasuresTableSeeder::class);
        $this->call(ScoreCardMetricsTableSeeder::class);
        $this->call(ScoreCardsTableSeeder::class);
    }
}
