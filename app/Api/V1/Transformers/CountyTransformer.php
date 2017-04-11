<?php

namespace App\Api\V1\Transformers;

use App\County;

class CountyTransformer extends Transformer
{
    public function transform($county)
    {
        return [
                'id' => $county->id,
                'name' => $county->name,
                'code' => $county->code
        ];
    }
}
