<?php

namespace App\Api\V1\DataBuilders\Answers;

class InstitutionTypeSelector {

    const MINISTRY_TYPE = 'ministry';
    const COUNTY_TYPE = 'county';
    const ANTICURRUPTION = 'anticorruption';
    
    /**
     * @param string $type
     * @return \App\Api\V1\DataBuilders\Answers\Builder
     */
    public static function getByInstitution($type) {
        switch ($type) {
            case static::MINISTRY_TYPE: 
                return new CentralInstitutionBuilder($institution);
            case static::COUNTY_TYPE:
                return new TownHallInstitutionBuilder($institution);
            case static::ANTICURRUPTION:
                return new CentralInstitutionBuilder($institution);
        }
    }
    
}