<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\CountyTransformer;
use App\Http\Controllers\Controller;
use App\County;
use App\Api\V1\CORS\Headers;

class CountiesController extends Controller
{
    use Headers;
    
    public function listAll(CountyTransformer $transformer)
    {
        $county = County::get();

        return response()->json([
                'data' => $transformer->transformCollection($county->all())
        ], 200, $this->getHeaders());
    }
}
