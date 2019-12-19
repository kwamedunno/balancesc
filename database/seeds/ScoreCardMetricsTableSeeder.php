<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ScoreCardMetricsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'score_card_metrics';
        $this->filename = base_path().'/database/seeds/csvs/score_card_metrics.csv';
        $this->mapping = [
			0 => 'metric',
			1 => 'scorecard',
            2 => 'measure',
            3 => 'score',
            4 => 'target',
            5 => 'weight',
           
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