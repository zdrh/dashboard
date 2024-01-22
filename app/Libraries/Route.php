<?php

namespace App\Libraries;

use \stdClass;

class Route
{
    function __construct()
    {
    }
    /**
     * porovná reálné routy se stavem v tabulce rout
     * $routesArray - pole všech rout, klíčem je routa, hodnotou je Controller/metoda
     * $routesTable - pole obejktů s routama v tabulce rout
     * 
     * return Value - aktualizované pole $routesTable, kde je u každé routy doplněn atribut status - 0 - beze změn, 1 - nová routa, 2 - změněná routa, 3 - smazaná routa
     */
    function checkRoutes($routesArray, $routesTable)
    {
        $result = array();
        foreach ($routesArray as $key => $route) {
            if ($key != "__hot-reload") {
                $status = $this->testRoute($key, $route, $routesTable);
                if($status->status != 1){
                    $id = $this->findId($routesTable, $status->id, 'id');
                    $result[$id]->status = $status;
                    if ($status == 2) {
                        $result[$id]->route = $key;
                        $result[$id]->cobtroller = $route;
                    }
                } else {
                    $object = new stdClass();
                    $object->route = $key;
                    $object->controller = $route;
                    $object->status = $status->status;
                    $result[] = $object;
                    
                }
                
            }
        }

        return $result;
    }

    private function testRoute($route, $controller, $routesTable)
    {
        $result = new stdClass();
        $result->status = 1;
       
        foreach ($routesTable as $row) {
            $result->id = $row->id;
            if ($row->route == $route) {
                //pokud je stejná routa
                if ($row->controller == $controller) {
                    //je stejná routa i controller
                    $result->status = 0;
                } else {
                    $result->status = 2;
                }
            }
        }

        return $result;
    }
    /**
     * projde pole objektů $array a hledá v kolikátém prvku je v atributu $column hodnota $value;
     */
    private function findId($array, $value, $column)
    {
        $result = NULL;
        foreach ($array as $key => $row) {
            if ($row->$column == $value) {
                $result = $key;
            }
        }

        return $result;
    }
}
