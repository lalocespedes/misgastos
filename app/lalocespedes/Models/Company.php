<?php

namespace lalocespedes\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class Company extends eloquent
{
	
	protected $table = 'company';

	protected $fillable = [
		'value'
	];

	public function tax_id() {

		return $this->where('key', 'tax_id')->first()->value;

	}

}