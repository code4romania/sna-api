<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\QuestionTransformer;
use App\Http\Controllers\Controller;
use App\Question;
use App\Api\V1\CORS\Headers;

class QuestionsController extends Controller
{
    use Headers;
    
    public function listAll(QuestionTransformer $transformer)
    {
        $question = Question::get();

        return response()->json([
                'data' => $transformer->transformCollection($question->all())
        ], 200, $this->getHeaders());
    }

    public function getByStep($category, QuestionTransformer $transformer) {
        if (filter_var($category, FILTER_VALIDATE_INT) && (int)$category >= 0 ) {
            $question = Question::where('question_step', $category)->get();

            return response()->json([
                    'data' => $transformer->transformCollection($question->all())
            ], 200, $this->getHeaders());
        } else {
            return response()->json([
                'message' => '{step} should be a positive integer'
            ], 400, $this->getHeaders());
        }
    }
}
