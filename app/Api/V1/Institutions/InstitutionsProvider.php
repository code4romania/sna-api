<?php

namespace App\Api\V1\Institutions;

use App\County;
use App\InstitutionType;
use App\Institution;

class InstitutionsProvider {
    
    /**
     * @param string $typeCode
     * @return Institution[]
     */
    public static function getInstitutionsFor($typeCode) {
        switch($typeCode) {
            case 'county': 
                return County::get();
            default:
                $institutionType = InstitutionType::where('institution_type', $typeCode)->first();
                return Institution::where('type_id', $institutionType->id)->get();
        }
    }
    
}