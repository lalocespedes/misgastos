<?php

namespace lalocespedes\Expense;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Query\Expression as Expression;

use Carbon\Carbon;

/**
* 
*/
class Expense extends Eloquent
{
	protected $table = 'expenses';

	protected $fillable = [
		'supplier_id',
		'category_id',
		'user_id',
		'expense_date_entered',
		'expense_description',
		'expense_amount',
		'expense_subtotal',
		'expense_descuento',
		'expense_folio',
		'expense_serie',
		'expense_moneda',
		'expense_TipoCambio',
		'expense_condicionesDePago',
		'expense_noCertificado',
		'expense_certificado',
		'expense_formaDePago',
		'expense_metodoDePago',
		'expense_NumCtaPago',
		'expense_LugarExpedicion',
		'expense_sello',
		'expense_uuid',
	];

	public function user()
    {
        return $this->belongsTo('lalocespedes\User\User');
    }

   	public function supplier()
    {
        return $this->belongsTo('lalocespedes\Models\Suppliers');
    }

    public function items()
    {
    	return $this->hasMany('lalocespedes\Models\Expense_items');
    }

    public function taxes()
    {
    	return $this->hasMany('lalocespedes\Models\Expense_taxes')->with('tax_rates');

    }

	public function category()
	{

    	return $this->belongsto('lalocespedes\Category\Category');
	}

	public function this_month()
	{

		$start = new Carbon('first day of this month');

		return $this->where('expense_date_entered','>=', $start);

	}

	public function this_year()
	{

		$start = new Carbon();
		$year = $start->startOfYear();

		return $this->where('expense_date_entered','>=', $year);
	}

	public function category_first()
	{
		$start = new Carbon('first day of this month');

		//return $this->with('category')->where('expense_date_entered','>=', $start)->groupBy('category_id')->orderBy('aggregate', 'desc')->get('expense_amount');
		return $this->join('expense_category', 'expenses.category_id', '=', 'expense_category.id')
					->select('name', new Expression('sum(expense_amount) as suma'))
            		->where('expense_date_entered','>=', $start)
            		->groupBy('category_id')
            		->orderBy('suma', 'desc')
            		->take(5);

	}

}