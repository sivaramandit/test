<?php namespace App\Models;

use CodeIgniter\Model;

class UserCurrencyModel extends Model
{
	protected $table      = 'user_currency';
	protected $primaryKey = 'user_currency_id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'user_id', 'source','destination', 'convertion_value'
	];

}
