<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['county_id', 'name', 'type_id'];
    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
