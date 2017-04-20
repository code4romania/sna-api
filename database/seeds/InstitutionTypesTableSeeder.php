<?php

use Illuminate\Database\Seeder;
use App\InstitutionType;

class InstitutionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['ministry', 'anticorruption', 'county'];
        foreach ($types as $type) {
          $institutionType = new InstitutionType();
          $institutionType->institution_type = $type;
          $institutionType->save();
        }
    }
}
