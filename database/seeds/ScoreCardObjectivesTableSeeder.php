<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ScoreCardObjectivesTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'score_card_objectives';
        $this->filename = base_path().'/database/seeds/csvs/score_card_objectives.csv';
        $this->mapping = [
            0 => 'score_card',
            1 => 'objective',
            2 => 'parent',
           
        ];
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		parent::run();
	}
}