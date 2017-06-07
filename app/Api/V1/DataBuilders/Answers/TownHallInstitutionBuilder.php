<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\AggregatedCounty;
use App\County;
use App\Question;
use App\Step;

class TownHallInstitutionBuilder extends Builder {
    public function getAnswersFor($county) {
        $output = array('countyId' => $county->id,
                        'name' => $county->name,
                        'answers' => array()
        );
        $aggregatedAnswers = AggregatedCounty::select('county_id', 'question_id', 'aggregated_answer_value', 'year')->where('county_id',$county->id)->get();
        $steps = Step::select('id')->where('id', '>', 0)->get();
        $answers = [];
        foreach($steps as $step) {
            $answer['stepId'] = $step;
            $indicators = [];
            foreach($aggregatedAnswers as $answer) {
                $indicator['indicatorId'] = $answer->question_id;
                $indicator['values'] = array('value' => $answer->aggregated_answer_value, 'year' => $answer->year);
                array_push($indicators, $indicator);
            }
            $answer['indicators'] = $indicators;
            array_push($answers, $answer);
        }
        $output['answers'] = $answers;
        return $output;
    }
}