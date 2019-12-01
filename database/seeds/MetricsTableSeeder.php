<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class MetricsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'metrics';
        $this->filename = base_path().'/database/seeds/csvs/metrics.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'description',
            2 => 'measure',
           
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
