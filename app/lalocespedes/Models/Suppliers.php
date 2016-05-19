<?php

namespace lalocespedes\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class Suppliers extends eloquent
{
	protected $table = 'suppliers';

	protected $fillable = [
		'supplier_name',
		'supplier_active',
		'supplier_tax_id'
	];
}