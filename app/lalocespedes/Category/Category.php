<?php

namespace lalocespedes\Category;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class Category extends Eloquent
{
	protected $table = 'expense_category';

	protected $fillable = [
		'name'
	];

	public function expense()
	{

    	return $this->HasMany('lalocespedes\Expense\Expense');
	}

}