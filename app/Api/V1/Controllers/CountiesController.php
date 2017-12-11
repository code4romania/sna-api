<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\CountyTransformer;
use App\Http\Controllers\Controller;
use App\County;
use App\Api\V1\CORS\Headers;

class CountiesController extends Controller
{
    use Headers;
    
    //TODO: this is a horrible, horrible thing I'm doing here and have to refactor.
    private $excludeList = array('AI', 'MI');
    
    public function listAll(CountyTransformer $transformer)
    {
        $county = County::whereNotIn('code', $this->excludeList)->get();

        return response()->json([
                'data' => $transformer->transformCollection($county->all())
        ], 200, $this->getHeaders());
    }
}
