<?php

use Illuminate\Database\Seeder;
use App\Judete;
use App\City;
use App\Institution;

class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutions = $this->getInstitutions();

        foreach ($institutions as $institution) {
          $institutionDB = new Institution();
          $institutionDB->name = $institution;
          if (strpos($institution, 'Primaria') !== false) {
            $institutionDB->type = 'county';
          }
          elseif (strpos($institution, 'Ministerul ') !== false || strpos($institution, 'Ministrul ') !== false) { //see id 107 @judete
            $institutionDB->type = 'minister';
          }
          else {
            $institutionDB->type = 'anticoruption';
          };
          $institutionDB->save();
        }
    }

    private function getInstitutions() {
      $institutions = [];
      $nationalInstitutions = Judete::where('id_j', '>', 85)->get();
      foreach ($nationalInstitutions as $item) {
        array_push($institutions, $item->judet);
      }
      $cities = City::all();
      foreach ($cities as $city) {
        array_push($institutions, 'Primaria ' . $city->name);
      }
      return $institutions;
    }
}
