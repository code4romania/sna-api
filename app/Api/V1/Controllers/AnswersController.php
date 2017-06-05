<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Institution;
use App\InstitutionType;
use App\Api\V1\DataBuilders\Answers\InstitutionTypeSelector;
use App\Api\V1\CORS\Headers;

class AnswersController extends Controller
{
    use Headers;
    
    public function listByInstitutionType($institutionType)
    {
        $answersBuilder = InstitutionTypeSelector::getByInstitution($institutionType);
        $institutionType = InstitutionType::where('institution_type', $institutionType)->first();
        $institutions = Institution::where('type_id', $institutionType->id)->get();
        $output = array();
        foreach ($institutions as $institution) {
            $output[] = $answersBuilder->getAnswersFor($institution);
        }

        return response()->json($output, 200, $this->getHeaders());
    }
}