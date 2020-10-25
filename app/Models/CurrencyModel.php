<?php namespace App\Models;

use CodeIgniter\Model;

class CurrencyModel extends Model
{
	protected $table      = 'currency_list';
	protected $primaryKey = 'currency_list_id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [];
		
	
	protected $validationRules = [];


   

}
