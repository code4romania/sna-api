<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\InstitutionTransformer;
use App\Http\Controllers\Controller;
use App\Institution;
use App\InstitutionType;

class InstitutionsController extends Controller
{
    public function getByType($type, InstitutionTransformer $transformer)
    {
      $typeId = InstitutionType::where('institution_type', $type)->get()->pluck('id');
      $institutions = Institution::where('institution_type_id', $typeId)->get();
      return response()->json([
              'data' => $transformer->transformCollection($institutions->all())
      ], 200);
    }
}
