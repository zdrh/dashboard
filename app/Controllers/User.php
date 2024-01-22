<?php

namespace App\Controllers;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\User as UserModel;
use App\Models\Groups as GroupsModel;
use App\Libraries\ArrayLib;
use App\Libraries\User as UserLib;


class User extends AdminController
{
    
    var $data;
    var $arrayLib;
    var $userLib;
    var $user;
    var $group;
    

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->user = new UserModel();
        $this->group = new GroupsModel();
        $this->arrayLib = new ArrayLib();
        $this->userLib = new UserLib();
       
    }
    public function index()
    {

        $this->data['title'] = "Seznam uživatelů";
        $users = $this->user->join('users_groups', 'users_groups.user_id=users.id', 'inner')->join('groups', 'users_groups.group_id=groups.id', 'inner')->orderBy('users.id', 'asc')->orderBy('groups.id', 'asc')->findAll();
        var_dump($users);
        $this->data['users'] = $this->arrayLib->groupArray($users, 'user_id');

        echo view('backend/userList', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = "Editovat uživatele";
        $this->data['userEdit'] = $this->ionAuth->user($id)->row();
        $allGroups = $this->group->orderBy('id', 'asc')->findAll();
        $userGroups = $this->group->join('users_groups',  'users_groups.group_id=groups.id', 'inner')->where('user_id', $id)->orderBy('groups.id', 'asc')->findAll();
        $this->data['groups'] = $this->arrayLib->compareArray($allGroups, 'id', $userGroups, 'group_id', 'inGroup');
        echo view('backend/editUser', $this->data);
    }

    public function update($id)
    {
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $photo = $this->request->getFile('photo');
        $group = $this->request->getPost('group');
        $editingUser = $this->ionAuth->user($id)->row();


        //testování uploadu a následné nahrání
        $data = array();
        if ($photo->getName() != "" and !$photo->hasMoved()) {
            //uploadovalo se a obrázek se ještě nenahrál na server
            $imageName = $editingUser->username . "." . $photo->getClientExtension();
            $result = $photo->move($this->form->uploadPath, $imageName);
            if (!$result) {
                $this->session->setFlashData('message', 'Obrázek se nepodařilo nahrát');
                $this->session->setFlashData('type', 'danger');
                return redirect()->route('admin/user/edit/' . $id);
            } else {
                $data['photo'] = $imageName;
            }
        }

        // upload je v pořádku nebo jsme ho neřešili vůbec, nahrajeme změny do DB


        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;

        $result = $this->ionAuth->update($id, $data);
        if (!$result) {
            $this->session->setFlashData('message', 'Změny uživatele se neprovedly');
            $this->session->setFlashData('type', 'danger');
            return redirect()->route('admin/user/edit/' . $id);
        }


        $return = $this->userLib->updateGroups($group, $editingUser->id);
        if ($return) {
            $this->session->setFlashData('message', 'Všechny změny proběhly v pořádku');
            $this->session->setFlashData('type', 'success');
            return redirect()->route('admin/users');
        } else {
            $this->session->setFlashData('message', 'Změna rolí se neprovedla');
            $this->session->setFlashData('type', 'danger');
            return redirect()->route('admin/user/edit/' . $id);
        }
    }

    public function remove($id)
    {
        $result = $this->userLib->removeUser($id);
        if($result) {
            $this->session->setFlashData('message', 'Všechny změny proběhly v pořádku');
            $this->session->setFlashData('type', 'success');
            return redirect()->route('admin/users');
        } else {
            $this->session->setFlashData('message', 'Uživatele se smazat nepodařilo');
            $this->session->setFlashData('type', 'danger');
            return redirect()->route('admin/users');
        }
    }
}
