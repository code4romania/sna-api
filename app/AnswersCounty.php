<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswersCounty extends Model
{
    protected $fillable = ['institution_id', 'question_id', 'question_step', 'value', 'year'];
}
