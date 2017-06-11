<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Institution;
use App\InstitutionType;
use App\Api\V1\DataBuilders\Answers\AnswersBuilderSelector;
use App\Api\V1\CORS\Headers;
use App\Api\V1\Institutions\InstitutionsProvider;

class AnswersController extends Controller
{
    use Headers;
    
    public function listByInstitutionType($institutionType)
    {
        $answersBuilder = AnswersBuilderSelector::getByInstitution($institutionType);
        $institutions = InstitutionsProvider::getInstitutionsFor($institutionType);
        $output = array();
        foreach ($institutions as $institution) {
            $output[] = $answersBuilder->getAnswersFor($institution);
        }

        return response()->json($output, 200, $this->getHeaders());
    }
}
