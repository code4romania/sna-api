<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Indicator;

class IndicatorsController extends Controller
{
    public function listAll()
    {
      $indicator = Indicator::select('id', 'name')->where('id', '>', 0)->get();

        return response()->json([
                'data' => $indicator->all()
        ], 200);
    }
}
