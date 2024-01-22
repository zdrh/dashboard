<?php

namespace App\Controllers;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use \IonAuth\Config\IonAuth as IonConfig;
use \IonAuth\Libraries\IonAuth;
use App\Libraries\Email as MyEmail;


class Main extends FrontEndController
{
    
    var $ionAuth;
    var $config;
    var $myEmail;


    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->ionAuth = new IonAuth();
        $this->myEmail = new MyEmail();
        $this->config = new IonConfig();
        $this->data['locale'] = $this->locale;
        
    }
    public function index()
    {
        $this->data["title"] = "Home";
        $this->data["ion"] = $this->ionAuth->user()->row();
        echo view('frontend/homePage', $this->data);
    }

    public function login()
    {
        $this->data["title"] = "Login";
        echo view('frontend/loginForm', $this->data);
    }

    public function login2()
    {

        $this->data["title"] = "Login";
        echo view('frontend/loginForm2', $this->data);
    }

    public function loginComplete()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $login = $this->ionAuth->login($username, $password);

        if ($login) {
            return redirect()->route('admin/dashboard');
        } else {
            $this->session->setFlashData('message', 'Takový uživatel neexistuje');
            $this->session->setFlashData('type', 'danger');
            return redirect()->route('login2');
        }
    }

    public function register()
    {

        $this->data["minPasswordLength"] = $this->config->minPasswordLength;
        $this->data["title"] = "Registrovat";
        echo view('frontend/registerForm', $this->data);
    }

    public function register2()
    {
        $this->data["minPasswordLength"] = $this->config->minPasswordLength;
        $this->data["title"] = "Registrovat";
        echo view('frontend/registerForm2', $this->data);
    }

    public function registerComplete()
    {
        $username = $this->request->getPost('username');
        $username = (string) $username;
        $name = $this->request->getPost('name');
        $surname = $this->request->getPost('surname');
        $email = $this->request->getPost('email');
        $email = (string) $email;
        $password = $this->request->getPost('password');
        $password = (string) $password;

        $data = array(
            'first_name' => $name,
            'last_name' => $surname
        );

        $result = $this->ionAuth->register($username, $password, $email, $data);
        if (is_int($result)) {

            $this->session->setFlashdata('message', 'Účet úspěšně vytvořen');
            $this->session->setFlashData('type', 'success');
            return redirect()->route('login2');
        } else {
            $this->session->setFlashdata('error', 'Něco se nepodařilo');
            $this->session->setFlashData('type', 'error');
            return redirect()->route('register2');
        }
    }

    public function registerUsername()
    {
        $username = $this->request->getPost("username");
        $rules = [
            'username' => "is_unique[users.username]",
        ];
        $data = array(
            'username' => $username,

        );
        $this->validation->setRules($rules);
        $result = $this->validation->run($data);
        $result2 = json_encode($result);
        echo $result2;
    }

    public function registerEmail()
    {
        $email = $this->request->getPost("email");
        $rules = [
            'email' => "is_unique[users.email]",
        ];
        $data = array(
            'email' => $email,

        );
        $this->validation->setRules($rules);
        $result = $this->validation->run($data);
        $result2 = json_encode($result);
        echo $result2;
    }

    public function pokus()
    {
        $this->data["title"] = "Pokus";
        echo view('frontend/pokus', $this->data);
    }

    public function forgottenPassword()
    {
        $this->data["title"] = "Zapomenuté heslo";
        echo view('frontend/forgottenPassword', $this->data);
    }

    public function forgottenPasswordComplete()
    {
        $email = $this->request->getPost('email');
        $result = $this->ionAuth->emailCheck($email);
        if ($result) {
            $key = $this->ionAuth->forgottenPassword($email);
            $this->myEmail->sendPasswordCode($email, $key);
            $this->session->set('email', $email);
        }

        return redirect()->route('forgotten-password-message');
    }

    public function forgottenPasswordMessage()
    {
        $this->data["title"] = "Zapomenuté heslo";
        $this->data["email"] = $this->session->get('email');
        $this->data["expiration"] = $this->config->forgetPasswordExpiration;
        echo view('frontend/forgottenPasswordMessage', $this->data);
    }
}
