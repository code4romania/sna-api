<?php

use Illuminate\Database\Seeder;
use App\CountyPopulation;
use App\Helpers\CsvHandler;

class CountiesPopulationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CsvHandler::convertToArray('resources/files/county/county_population.csv');
        if ($data) {
            foreach ($data as $row) {
                CountyPopulation::create([
                    'county_id' => $row[0],
                    'population' => $row[1],
                    'year' => $row[2],
                ]);
            }
        }
    }
}
