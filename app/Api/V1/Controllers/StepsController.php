<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Step;
use App\Api\V1\CORS\Headers;

class StepsController extends Controller
{
    use Headers;
    
    public function listAll()
    {
      $step = Step::select('id', 'name')->where('id', '>', 0)->get();

        return response()->json([
                'data' => $step->all()
        ], 200, $this->getHeaders());
    }
}
