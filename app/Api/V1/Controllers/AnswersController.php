<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Question;
use App\Api\V1\Transformers\AnswerTransformer;
use App\Institution;
use App\InstitutionType;

class AnswersController extends Controller
{
    public function listByInstitutionType($institutionType, AnswerTransformer $transformer)
    {
        $institutionTypeFetched = InstitutionType::where('institution_type', $institutionType)->first();
        $institutions = Institution::where('type_id', $institutionTypeFetched->id)->get();
        $employeesQuestion = Question::where('code', 'EMPLOYEES')->first();
        foreach ($institutions as $institution) {
            $employees = $institution->answers->where('question_id', $employeesQuestion->id)->first();
            echo $employees->answer.'    ';
            echo $institution->name.'<br>';
        }
        die();

        return response()->json([
                'data' => $transformer->transformCollection($question->all())
        ], 200);
    }
}
