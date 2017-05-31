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

    public function getByStep($category, QuestionTransformer $transformer) {
        if (filter_var($category, FILTER_VALIDATE_INT) && (int)$category >= 0 ) {
            $question = Question::where('question_step', $category)->get();

            return response()->json([
                    'data' => $transformer->transformCollection($question->all())
            ], 200)->header('Access-Control-Allow-Origin', '*');
        } else {
            return response()->json([
                'message' => '{step} should be a positive integer'
            ], 400)->header('Access-Control-Allow-Origin', '*');
        }
    }
}
