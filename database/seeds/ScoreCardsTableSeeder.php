<?php

use Illuminate\Database\Seeder;

class ScoreCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('score_cards')->insert([

            'id'=> '1',
            'staff'=>'1',
            'period'=>'11-2019',
            'last_updated_by'=>'1'

        ]);
    }
}