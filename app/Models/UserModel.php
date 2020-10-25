<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table      = 'users';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'name', 'email','password', 'activate_hash', 'file_path', 'contact_no'
	];

	
	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'registration' => [
			'name' 				=> 'required|min_length[2]',
			'email' 			=> 'required|valid_email|is_unique[users.email]',
			'activate_hash'	=> 'required',
			'password'	=> 'required',
		],
		'updateAccount' => [
			'id'	=> 'required|is_natural_no_zero',
			'name'	=> 'required|min_length[2]'
		],
		'changeEmail' => [
			'id'			=> 'required|is_natural_no_zero',
			'new_email'		=> 'required|valid_email|is_unique[users.email]',
			'activate_hash'	=> 'required'
		]
	];





	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}

    //--------------------------------------------------------------------

    /**
     * Hashes the password after field validation and before insert/update
     */
	protected function hashPassword(array $data)
	{
		if (! isset($data['data']['password'])) return $data;

		$data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		unset($data['data']['password']);
		unset($data['data']['password_confirm']);

		return $data;
	}


   

}
