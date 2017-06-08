<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\County;
use App\Step;

class TownHallInstitutionBuilder extends Builder {
    public function getAnswersForCounty($county, $aggregatedAnswers) {
        $output = array('countyId' => $county->id,
                        'name' => $county->name,
                        'answers' => array()
        );
        // aici am incercat sa filtrez $aggregatedAnswers intr-un array care contine doar raspunsurile pe county-ul pe care suntem
        // ca sa fie mai putine elemente de iterat, dar nu am reusit sa dau $county->id ca parametru functiei callback din array_filter
        // solutia a fost sa adaug o conditie suplimentara in if-ul de la linia 32.
        $steps = Step::select('id')->where('id', '>', 0)->get();
        $answers = array();
        foreach($steps as $step) {
            $answer['stepId'] = $step->id;
            $answer['indicators'] = $this->getIndicatorsValue($aggregatedAnswers, $step->id, $county->id);
            array_push($answers, $answer);
        }
        $output['answers'] = $answers;
        return $output;
    }

    private function getIndicatorsValue($answers, $step, $countyId) {
        $indicators = array();
        foreach($answers as $answer) {
            if ($answer->county_id == $countyId && $answer->question_step == $step) {
                $indicator['indicatorId'] = $answer->question_id;
                $indicator['values'] = array('value' => $answer->aggregated_answer_value, 'year' => $answer->year);
                array_push($indicators, $indicator);
            }
        }
        return $indicators;
    }
}