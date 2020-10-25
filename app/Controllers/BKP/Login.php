<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

class Login extends Controller
{

    public function index()
    {    
      
        return view('Login/login');
    }  

    public function auth_login(){
      
         $login = new LoginModel();

        

       if ($this->request->getMethod() === 'post' && $this->validate([
            'email_id' => 'required',
            'password'  => 'required'
        ]))
    {
        

       $user_data = array("email" => $this->request->getPost('email_id'), 
                          "password" => $this->request->getPost('password'));


         $user = $login->where($user_data)->first();

        if ( is_null($user)) {
          return redirect()->to('index')->withInput()->with('error', lang('Auth.wrongCredentials'));
        }else{
            return redirect()->to( base_url('dashboard'));
        }


    }else{
        return view('Login/login');
    }
    }  

    public function create()
    {    
        
        $model = new LoginModel();

        echo $this->request->getMethod();  exit;

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ]))
    {
        $model->save([
            'title' => $this->request->getPost('title'),
            'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
            'body'  => $this->request->getPost('body'),
        ]);

        echo view('news/success');

    }
         
         echo "<pre />"; print_r($_POST); exit;

        $data = [
 
            'email'  => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
            ];

            echo "<pre />"; print_r($data); exit;
 
        $save = $model->insert($data);
 

        return view('Login/create');
    }

    public function store()
    {  

        helper(['form', 'url']);
        
        $model = new UserModel();

        $data = [

            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            ];

        $save = $model->insert($data);

        return redirect()->to( base_url('public/index.php/users') );
    }

    public function edit($id = null)
    {
     
     $model = new UserModel();

     $data['user'] = $model->where('id', $id)->first();

     return view('public/index.php/edit-user', $data);
    }

    public function update()
    {  

        helper(['form', 'url']);
        
        $model = new UserModel();

        $id = $this->request->getVar('id');

        $data = [

            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            ];

        $save = $model->update($id,$data);

        return redirect()->to( base_url('public/index.php/users') );
    }

    public function delete($id = null)
    {

     $model = new UserModel();

     $data['user'] = $model->where('id', $id)->delete();
     
     return redirect()->to( base_url('public/index.php/users') );
    }
}
