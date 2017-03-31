<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_text', 'required', 'type', 'unit_of_measurement', 'max_length', 'answer_is_numeric', 'chart', 'question_step'];
    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
