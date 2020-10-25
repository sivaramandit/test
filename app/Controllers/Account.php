<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\CurrencyModel;
use App\Models\UserCurrencyModel;
use Config\Email;
use Config\Services;


class Account extends Controller
{
    protected $session = [];
    protected $client = [];

     public function __construct()
    {
        // start session
        $this->session = Services::session();

       
        $this->config = config('App');
    }



    public function index()
    {    
         $data['name'] =  $this->session->userData['name'];

          $currency = new CurrencyModel();

         $data['currencies'] =  $currency->findAll();

         $userCurrency = new UserCurrencyModel();

         $data['userCurrency'] = $userCurrency->where('user_id', $this->session->userData['id'])->find();

      return view('account/account', $data);
    }  
    

    public function currency_convertion(){

        $currency = new CurrencyModel();

        $selected_currency =  $currency->where('currency_code', $this->request->getPost('destination'))->first();


        echo json_encode(array("convertion" => $selected_currency['value']));
    }



    public function update_my_favirite()
    {    


        
        $currency = new CurrencyModel();

        $usersCurrency = new UserCurrencyModel();


         $selected_currency =  $currency->where('currency_code', $this->request->getPost('destination'))->first();
      

        $usercurrency = [
            'source'              => $this->request->getPost('source'),
            'destination'             => $this->request->getPost('destination'),
            'user_id'          =>  $this->session->userData['id'],
            'convertion_value'     =>$selected_currency['value']
        ];



        if (! $usersCurrency->save($usercurrency)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

       
         return redirect()->to(base_url('account'));



    }

      public function edit_profile()
    {    

        $data['id'] = $user_id =  $this->session->userData['id'];

        
        $user = new UserModel();

        $data['user_details'] =  $user->where('id', $user_id)->first();



         return view('account/edit_user', $data);



    }

    public function update_user(){


      
        $users = new UserModel();
       
        
         $hash = $this->generate_password(16);

          $file = $this->request->getFile('id_proof');

           $name = explode(".",$file->getName());
           $newName = date('Ymdhmis').".".end($name);


         $path = $this->request->getFile('id_proof')->store('userfiles/',$newName);

       
        $getRule = $users->getRule('registration');
        $users->setValidationRules($getRule);

        $user = [
             'id'            =>  $this->session->userData['id'],
            'name'              => $this->request->getPost('name'),
            'contact_no'              => $this->request->getPost('contact_no'),
            'file_path'         => $path
         ];


        if (! $users->save($user)) {

            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

      

         return redirect()->to(base_url('account'));


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
