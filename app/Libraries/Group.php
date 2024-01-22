<?php

namespace App\Libraries;

use App\Models\RoutesGroups;

class Group {

    var $routesGroups;

    function __construct() {
        $this->routesGroups = new RoutesGroups();
    }

    function updateGroups($group, $route_id) {
        var_dump($group);
        $data = $this->routesGroups->where('route_id', $route_id)->findAll();
        $this->routesGroups->transStart();
        foreach ($data as $row) {
            $id = $row->id;
            $this->routesGroups->delete($id);
        }

        /* foreach ($group as $item) {
            $data = array(
                'route_id' => $route_id,
                'group_id' => $item
            );
            $this->routesGroups->save($data);
       }
       $this->routesGroups->transComplete();

       return $this->routesGroups->transStatus();*/
    }
}