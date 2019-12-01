<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class MeasuresTableSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'measures';
        $this->filename = base_path().'/database/seeds/csvs/measures.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'description',
            2 => 'objective',
           
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
