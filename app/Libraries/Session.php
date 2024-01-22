<?php
namespace App\Libraries;

class Session {

    function __construct()
    {
        
    }
    /**
     * $session - celá session, se kterou chci pracovat
     * $array - pole, ve kterém jsou klíče, které ze session chci vytáhnout
     * result - pole, ve kterém jsou k jednotlivým klíčům přiřazeny hodnoty session
     */
    function getValues($session, $array) {
        $result = array();
        if(is_null($session)) {
            $result = $this->addValues($array, NULL);
        } else {
            foreach($array as $item) {
                if(!is_null($session->get($item))) {
                    $result[$item] = $session->get($item);
                } else {
                    $result[$item] = "";
                }
            }
        }

        return $result;
        
    }

    private function addValues($array, $value) {
        $result = array();
        if(!is_array($value)) {
            foreach($array as $item) {
                $result[$item] = $value;
            }
        } else {

        }

        return $result;
    }
}