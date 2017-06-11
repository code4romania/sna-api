<?php

namespace App\Api\V1\Institutions;

use App\County;

class InstitutionsProvider {
    
    /**
     * @param string $type
     * @return Institution[]
     */
    public static function getInstitutionsFor($type) {
        switch($type) {
            case 'county': 
                return County::get();
            default:
                $institutionType = InstitutionType::where('institution_type', $institutionType)->first();
                return Institution::where('type_id', $institutionType->id)->get();
        }
    }
    
}