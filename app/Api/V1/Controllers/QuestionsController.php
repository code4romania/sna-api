<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\QuestionTransformer;
use App\Http\Controllers\Controller;
use App\Question;

class QuestionsController extends Controller
{
    public function listAll(QuestionTransformer $transformer)
    {
    $question = Question::get();

    return response()->json([
            'data' => $transformer->transformCollection($question->all())
    ], 200);
    }
}
