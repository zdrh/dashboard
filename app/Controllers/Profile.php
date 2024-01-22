<?php

namespace App\Controllers;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Profile extends AdminController
{

    
    


    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function edit()
    {

        $this->data["title"] = "Editovat profil";
        echo view('backend/editProfile', $this->data);
    }
}
