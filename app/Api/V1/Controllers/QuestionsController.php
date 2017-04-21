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
        if ($step >= 0 && $step <= 12) {
            $question = Question::where('question_step', $step)->get();

            return response()->json([
                    'data' => $transformer->transformCollection($question->all())
            ], 200);
        } else {
            return response()->json(['message' => '/{step} should have a value between 0 and 12 inclusive'], 400);
        }
    }
}
