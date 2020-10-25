<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{

    public function index()
    {    
      
        return view('Login/register');
    }  



    public function create()
    {    
        
       helper('text');

        // save new user, validation happens in the model
        $users = new UserModel();
        $getRule = $users->getRule('registration');
        $users->setValidationRules($getRule);
        $user = [
            'name'              => $this->request->getPost('name'),
            'email'             => $this->request->getPost('email'),
      ];


        $users->save($user);


        exit;

        
        if (! $users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // send activation email
        helper('auth');
        send_activation_email($user['email'], $user['activate_hash']);

        // success
        return redirect()->to('login')->with('success', lang('Auth.registrationSuccess'));
    }

}
