<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ObjectivesTableSeeder extends CsvSeeder {

	public function __construct()
	{
		$this->table = 'objectives';
        $this->filename = base_path().'/database/seeds/csvs/objectives_2.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'description',
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
