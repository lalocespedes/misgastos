<?php

namespace lalocespedes\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class Expense_taxes extends Eloquent
{
	
	protected $table = 'expenses_taxes';

	protected $fillable = [
		'expense_id',
		'tax_rate_id',
		'tax_amount'
	];

	public function expense()
    {
        return $this->belongsTo('lalocespedes\Expense\Expense');
    }

    public function tax_rates()
    {
    	return $this->belongsTo('lalocespedes\Models\Tax_rates', 'tax_rate_id');
    }

}
