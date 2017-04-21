<?php

namespace App\Api\V1\Transformers;

use App\Question;

class QuestionTransformer extends Transformer
{
    public function transform($question)
    {
        return [
                'id' => $question->id,
                'text' => $question->question_text,
                'answerType' => $question->answer_is_numeric==1?'integer':'string',
                'maxLength' => $question->max_length,
                'step' => $question->question_step
        ];
    }
}
