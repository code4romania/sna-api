<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judete extends Model
{
    //for the regular tables in the old DB without a prefix
    protected $connection = 'mysql_no_prefix';
    
    protected $table = 'judete';
    
    public $timestamps = false;
}
