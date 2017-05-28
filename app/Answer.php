<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'institution_id', 'user_id', 'value'];
    
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
}
