<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\AggregatedCounty;
use App\County;
use App\Institution;
use App\InstitutionType;
use App\Api\V1\DataBuilders\Answers\InstitutionTypeSelector;

class AnswersController extends Controller
{
    public function listByInstitutionType($institutionType)
    {
        $answersBuilder = InstitutionTypeSelector::getByInstitution($institutionType);
        $institutionType = InstitutionType::where('institution_type', $institutionType)->first();
        if ($institutionType["institution_type"] != 'county') {
            $institutions = Institution::where('type_id', $institutionType->id)->get();
            $output = array();
            foreach ($institutions as $institution) {
                $output[] = $answersBuilder->getAnswersFor($institution);
            }
        } else {
            // am scos query-ul in afara pentru ca altfel s-ar fi executat pentru fiecare judet si ar fi durat super mult
            // prin asta am redus timpul la jumatate
            $aggregatedAnswers = AggregatedCounty::select('question_id', 'county_id', 'aggregated_answer_value', 'question_step', 'year')->get()->all();
            $counties = County::where('id', '<', '43')->get()->all();
            foreach ($counties as $county) {
                $output[] = $answersBuilder->getAnswersForCounty($county, $aggregatedAnswers);
            }
        }

        return response()->json($output, 200)->header('Access-Control-Allow-Origin', '*');
    }
}
