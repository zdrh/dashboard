<?php

namespace App\Controllers;



use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


use App\Models\Routes as RouteModel;
use App\Models\Groups;
use App\Libraries\ArrayLib;
use App\Libraries\Group as GroupLib;

class Route extends AdminController
{
    var $route;
    var $group;
    var $arrayLib;
    var $groupLib;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->route = new RouteModel();
        $this->group = new Groups();
        $this->arrayLib = new ArrayLib();
        $this->groupLib = new GroupLib();

    }

    public function index()
    {
        $routes = $this->route->join('routes_groups', 'routes.route_id2=routes_groups.route_id', 'left')->join('groups','routes_groups.group_id=groups.id', 'left')->orderBy('routes.route_id2', 'asc')->orderBy('groups.id', 'asc')->findAll();
        $this->data['routes'] = $this->arrayLib->groupArray($routes, 'route_id2');
        $this->data["title"] = "Seznam rout";
        echo view('backend/routeList', $this->data);
    }

    public function edit($id) {
        $this->data['title'] = "Editovat routu";
        $this->data['routeEdit'] = $this->route->join('routes_groups', 'routes.route_id2=routes_groups.route_id', 'left')->join('groups','routes_groups.group_id=groups.id', 'left')->find($id);
        $allGroups = $this->group->orderBy('id', 'asc')->findAll();
        $routeGroups = $this->group->join('routes_groups',  'routes_groups.group_id=groups.id', 'inner')->where('route_id', $id)->orderBy('groups.id', 'asc')->findAll();
        $this->data['groups'] = $this->arrayLib->compareArray($allGroups, 'id', $routeGroups, 'group_id', 'inGroup');
        echo view('backend/editRoute', $this->data);
    }

    public function update($id) {
        $description = $this->request->getPost('description');
        $group = $this->request->getPost('group');

        $data = array(
            'description' => $description,
            'route_id2' => $id
        );
        

        $result = $this->route->save($data);
        if (!$result) {
            $this->session->setFlashData('message', 'Změny rout se neprovedly');
            $this->session->setFlashData('type', 'danger');
            return redirect()->route('admin/route/edit/' . $id);
        }


        $return = $this->groupLib->updateGroups($group, $id);
        if ($return) {
            $this->session->setFlashData('message', 'Všechny změny proběhly v pořádku');
            $this->session->setFlashData('type', 'success');
            return redirect()->route('admin/routes/index');
        } else {
            $this->session->setFlashData('message', 'Změna skupin se neprovedla');
            $this->session->setFlashData('type', 'danger');
            return redirect()->route('admin/route/edit/' . $id);
        }
    }
}
