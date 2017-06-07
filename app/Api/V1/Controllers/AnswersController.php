<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
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
            $counties = County::where('id', '<', '43')->get()->all();
            foreach ($counties as $county) {
                $output[] = $answersBuilder->getAnswersFor($county);
            }
        }

        return response()->json($output, 200)->header('Access-Control-Allow-Origin', '*');
    }
}
