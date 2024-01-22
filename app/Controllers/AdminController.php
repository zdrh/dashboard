<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\Menu;
use \IonAuth\Libraries\IonAuth;
use Config\Form;
use App\Libraries\Session as MySession;


class AdminController extends BaseController
{
    var $menu;
    var $ionAuth;
    var $data;
    var $mySession;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $menu = new Menu();
        $this->menu = $menu->where('type',1)->orderBy('rank', 'asc')->findAll();
        $this->data["menu"] = $this->menu;
        $this->ionAuth = new IonAuth();
        $this->data["user"] = $this->ionAuth->user()->row();
        $this->data["form"] = new Form();
        $this->mySession = new MySession();
        
        $pole = array(
            'message',
            'type'
        );
        $mySession = $this->mySession->getValues($this->session, $pole);
        $this->data['type'] = $mySession['type'];
        $this->data['message'] = $mySession['message'];
        

    }
}
