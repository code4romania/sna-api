<?php

namespace App\Api\V1\Transformers;

use App\Institution;
use App\County;

class InstitutionTransformer extends Transformer
{
    public function transform($institution)
    {
        return [
                'id' => $institution->id,
                'name' => $institution->name,
                'county' => County::where('id', $institution->county_id)->get()->pluck('name')->first()
        ];
    }
}
