<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Institutions\Institution as InstitutionInterface;

class Institution extends Model implements InstitutionInterface
{
    protected $fillable = ['county_id', 'name', 'type_id'];
    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    public function getId()
	{
	    return $this->id;
	}
	
	public function getName() 
	{
	    return $this->name;
	}
}
