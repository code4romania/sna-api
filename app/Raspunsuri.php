<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raspunsuri extends Model
{
    //for the regular tables in the old DB without a prefix
    protected $connection = 'mysql_no_prefix';
    
    protected $table = 'raspunsuri';
    
    public $timestamps = false;
    
}
