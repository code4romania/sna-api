<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Institutions\Institution;

class County extends Model implements Institution
{
	protected $fillable = ['name', 'code'];
	
	public function cities()
	{
		return $this->hasMany('App\City');
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
