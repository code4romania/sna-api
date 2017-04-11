<?php

use Illuminate\Database\Seeder;
use App\Judete;
use App\City;
use App\Institution;
use App\County;

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

        foreach ($institutions as $institutionData) {
          $institution = $institutionData[0];
          $institutionCountyCode = $institutionData[1];
          
          $institutionDB = new Institution();
          $institutionDB->name = $institution;
          
          if (strpos($institution, 'Primaria') !== false) {
            $institutionDB->type = 'county';
            $county = County::where('code', '=', $institutionCountyCode)->first();
            $institutionDB->county_id = $county->id;
          }
          elseif (strpos($institution, 'Ministerul ') !== false || strpos($institution, 'Ministrul ') !== false) { //see id 107 @judete
            $institutionDB->type = 'ministry';
            $county = County::where('code', '=', 'MI')->first();
            $institutionDB->county_id = $county->id;
          }
          else {
            $institutionDB->type = 'anticorruption';
            $county = County::where('code', '=', 'AI')->first();
            $institutionDB->county_id = $county->id;
          }
          
          $institutionDB->save();
        }
    }

    private function getInstitutions() {
      $institutions = array();
      
      $nationalInstitutions = Judete::where('id_j', '>', 85)->get();
      foreach ($nationalInstitutions as $item) {
        array_push($institutions, array($item->judet, ''));
      }
      
      $cities = City::all();
      foreach ($cities as $city) {
        array_push($institutions, array('Primaria ' . $city->name, $city->county->code));
      }
      
      return $institutions;
    }
}
