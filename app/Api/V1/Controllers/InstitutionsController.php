<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\InstitutionTransformer;
use App\Http\Controllers\Controller;
use App\Institution;
use App\InstitutionType;
use App\Api\V1\CORS\Headers;

class InstitutionsController extends Controller
{
    use Headers;
    
    public function getByType($type, InstitutionTransformer $transformer)
    {
      $institution_types = InstitutionType::get()->pluck('institution_type')->all();
      if (in_array($type, $institution_types)) {
        $typeId = InstitutionType::where('institution_type', $type)->get()->pluck('id');
        $institutions = Institution::where('type_id', $typeId)->get();
        return response()->json([
                'data' => $transformer->transformCollection($institutions->all())
        ], 200, $this->getHeaders());
      } else {
        return response()->json(['message' => '/{type} should be anticorruption, ministry or county '], 400, $this->getHeaders());
      }
    }
}
