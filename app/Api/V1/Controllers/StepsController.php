<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Step;

class StepsController extends Controller
{
    public function listAll()
    {
      $step = Step::select('id', 'name')->where('id', '>', 0)->get();

        return response()->json([
                'data' => $step->all()
        ], 200)->header('Access-Control-Allow-Origin', '*');
    }
}
