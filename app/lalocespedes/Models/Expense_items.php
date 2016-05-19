<?php

namespace lalocespedes\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class Expense_items extends Eloquent
{
	
	protected $table = 'expenses_items';

	protected $fillable = [
		'expense_id',
		'item_name',
		'item_description',
		'item_qty',
		'item_price',
		'item_unidad'
	];

	public function expense()
    {
        return $this->belongsTo('lalocespedes\Expense\Expense');
    }

}