<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountyPopulation extends Model
{
    protected $table = 'counties_population';
    protected $fillable = [
        'county_id', 'population', 'year'
    ];
}
