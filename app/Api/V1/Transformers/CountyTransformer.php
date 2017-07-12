<?php

namespace App\Api\V1\Transformers;

use App\County;
use App\CountyPopulation;

class CountyTransformer extends Transformer
{
    public function transform($county)
    {
        $countyPopulationRows = CountyPopulation::where('county_id', $county->id)->get();
        $countyPopulation = array();

        foreach($countyPopulationRows as $row) {
            $countyPopulation[] = array('population' => $row->population,
                                        'year' => $row->year);
        }

        return [
            'id' => $county->id,
            'name' => $county->name,
            'code' => $county->code,
            'population' => $countyPopulation
        ];
    }
}
