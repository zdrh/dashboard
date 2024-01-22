<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\Menu;
use Config\Form;
use App\Libraries\Session as MySession;

class FrontEndController extends BaseController
{
    var $menu;
    var $data;
    var $mySession;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $menu = new Menu();
        $this->menu = $menu->where('type',2)->orderBy('rank', 'asc')->findAll();
        $this->data["menu"] = $this->menu;
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
