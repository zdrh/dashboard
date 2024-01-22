<?php

namespace App\Libraries;


use \IonAuth\Libraries\IonAuth;
use App\Models\Groups;


class User
{

    var $ionAuth;
    var $groups;

    function __construct()
    {
        $this->ionAuth = new IonAuth();
        $this->groups = new Groups();
    }
    /**
     * odebere uživatele ze všech jeho skupin a přidá do skupin, jejich id je uvedeno v poli $groups
     * $groups - pole, se skupinami, do kterých má být přidaný
     * $idUser - int, id uživatele, se kterým pracujeme
     */
    function updateGroups($groups, $idUser)
    {


        $this->groups->transStart();

        $this->ionAuth->removeFromGroup(NULL, $idUser);
        $this->ionAuth->addToGroup($groups, $idUser);

        $this->groups->transComplete();

        return $this->groups->transStatus();
    }
    /**
     * smaže uživatele z tabulky user a současně ho vymaže ze všech skupin
     */
    function removeUser($idUser) {
        $this->groups->transStart();
            $this->ionAuth->removeFromGroup(NULL, $idUser);
            $this->ionAuth->deleteUser($idUser);
        $this->groups->transComplete();

        return $this->groups->transStatus();
    }
}
