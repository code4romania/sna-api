<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chestionar extends Model
{
    //for the regular tables in the old DB without a prefix
    protected $connection = 'mysql_no_prefix';
    
    protected $table = 'chestionar';
    
    public $timestamps = false;
    
    protected $fillable = ['intrebare', 'req', 'type', 'valoare', 'char', 'numeric', 'chart', 'pas'];
}
