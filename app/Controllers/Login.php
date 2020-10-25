<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UserModel;

class Login extends Controller
{
    /**
     * Access to current session.
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Authentication settings.
     */
    protected $config;


    //--------------------------------------------------------------------

    public function __construct()
    {
        // start session
        $this->session = Services::session();

        // load auth settings
        $this->config = config('App');
    }

    //--------------------------------------------------------------------

    /**
     * Displays login form or redirects if user is already logged in.
     */
    public function index()
    {
        if ($this->session->isLoggedIn) {
            return redirect()->to('/account');
        }

        return view('Login/login');
    }

    //--------------------------------------------------------------------

    /**
     * Attempts to verify user's credentials through POST request.
     */
    public function auth_login()
    {
        // validate request
        $rules = [
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[5]',
        ];


        if (! $this->validate($rules)) {
            return redirect()->to('login')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // check credentials
        $users = new UserModel();
        $user = $users->where('email', $this->request->getPost('email'))->first();

       if (is_null($user)){
            
            return redirect()->to('/login')->withInput()->with('error', lang('App.wrongCredentials'));
        }

        // check activation
        if ($user['status'] != 'ACTIVE') {
            return redirect()->to('/login')->withInput()->with('error', lang('App.notActivated'));
        }

        // login OK, save user data to session
        $this->session->set('isLoggedIn', true);
        $this->session->set('userData', [
            'id'            => $user['id'],
            'name'          => $user['name'],
            'email'         => $user['email'],
        ]);

        return redirect()->to('/account');
    }

    //--------------------------------------------------------------------

    /**
     * Log the user out.
     */
    public function logout()
    {
        $this->session->remove(['isLoggedIn', 'userData']);

        return redirect()->to(base_url('login'));
    }

}
