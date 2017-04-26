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

    public function getByStep($step, QuestionTransformer $transformer) {
        if (filter_var($step, FILTER_VALIDATE_INT) && (int)$step >= 0 ) {
            $question = Question::where('question_step', $step)->get();

            return response()->json([
                    'data' => $transformer->transformCollection($question->all())
            ], 200);
        } else {
            return response()->json([
                'message' => '{step} should be a positive integer'
            ], 400);
        }
    }
}
