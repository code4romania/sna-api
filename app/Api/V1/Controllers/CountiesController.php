<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\CountyTransformer;
use App\Http\Controllers\Controller;
use App\County;

class CountiesController extends Controller
{
    public function listAll(CountyTransformer $transformer)
    {
        $county = County::get();

        return response()->json([
                'data' => $transformer->transformCollection($county->all())
        ], 200)->header('Access-Control-Allow-Origin', '*');
    }
}
