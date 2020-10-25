<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use Config\Email;
use Config\Services;

class Register extends Controller
{

    public function index()
    {    
      
        return view('Login/register');
    }  



    public function create()
    {    
       
        $locale = service('request')->getLocale();

      
        $users = new UserModel();
       
        $IsUserExist = $users->where('email', $this->request->getPost('email'))->first();

       
       if( $IsUserExist == ''){

        
         $hash = $this->generate_password(16);

          $file = $this->request->getFile('id_proof');

           $name = explode(".",$file->getName());
           $newName = date('Ymdhmis').".".end($name);


         $path = $this->request->getFile('id_proof')->store('userfiles/',$newName);

       
       /* $getRule = $users->getRule('registration');
        $users->setValidationRules($getRule);*/

        $user = [
            'name'              => $this->request->getPost('name'),
            'email'             => $this->request->getPost('email'),
            'contact_no'              => $this->request->getPost('contact_no'),
            'password'          => $this->generate_password(),
            'activate_hash'     => $hash,
            'file_path'         => $path
         ];
        


        if (! $users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // send activation email
        helper('auth');
        send_activation_email($user['email'], $user['activate_hash'], $user['password'] );

         return redirect()->to(base_url('login'));


       }else{
      

      return redirect()->to( base_url('register') );
      
     }
       
        


    }


    public function generate_password($length = 6)
    {
        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);
        //$id = date("ymd").date("His");
        $id = '';
        while ($length--) {
            $key = array_rand($final_array);
            $id .= $final_array[$key];
        }
        return $id;
    }

}
