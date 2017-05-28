<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Transformers\AnswerTransformer;
use App\Institution;
use App\InstitutionType;
use App\Api\V1\DataBuilders\Answers\InstitutionTypeSelector;

class AnswersController extends Controller
{
    public function listByInstitutionType($institutionType, AnswerTransformer $transformer)
    {
        $answersBuilder = InstitutionTypeSelector::getByInstitution($institutionType);
        $institutionType = InstitutionType::where('institution_type', $institutionType)->first();
        $institutions = Institution::where('type_id', $institutionType->id)->get();
        $output = array();
        foreach ($institutions as $institution) {
            $output[] = $answersBuilder->getAnswersFor($institution);
        }

        return response()->json($output, 200);
    }
}
