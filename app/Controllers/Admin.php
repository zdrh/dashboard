<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\Routes;
use App\Libraries\Route as RouteLib;



class Admin extends AdminController
{
    var $route;
    var $routeLib;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->route = new Routes();
        $this->routeLib = new RouteLib();

       
        
    }
/**
 * zkonroluje routy a metody v tabulce routes, případně je přidá, upraví atd.
 */
    public function routes() {
        $r = service('routes');
        
        $routesTable = $this->route->findAll();
        $pole = $this->routeLib->checkRoutes($r->getRoutes(),$routesTable);
        $this->route->updateRouteTable($pole);
        
        
    }

    public function dashboard()
    {
        $this->data["title"] = "Dashboard";
       $this->data["user"] = $this->ionAuth->user()->row();
       
        echo view ("backend/dashboard", $this->data);
    }

    public function logout() {
       $this->ionAuth->logout();

        return redirect()->route('/');

    }

    public function editProfile() {
       
    }
}
