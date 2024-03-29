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
        [
            'id'=> '1',
            'staff'=>'2',
            'period'=>'01-2020',
            'total_score'=> '66',
            'last_updated_by'=>'2'
        ],
        [
            'id'=> '2',
            'staff'=>'3',
            'period'=>'01-2020',
            'total_score'=>'60',
            'last_updated_by'=>'3'
        ]

        ]);
    }
}
