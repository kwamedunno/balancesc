<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ScoreCardMeasuresTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'score_card_measures';
        $this->filename = base_path().'/database/seeds/csvs/score_card_measures_2.csv';
        $this->mapping = [
            0 => 'measure',
            1 => 'objective',
           
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