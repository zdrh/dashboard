<?php

namespace App\Libraries;

class ArrayLib
{

    public function __construct()
    {
    }

    

    /**
     * seskupí pole objektů podle proměnné. Použitelné u výsledků dotazů, kde se některé výsledky vyskytují opakovaně (např. výpis uživatelů se skupinami, někteří uživatelé jsou tam vícekrát, protžoe jsou ve více skupinách)
     * 
     * $array - pole objektů
     * $grouped - podle kterého atributu to budeme seskupovat
     * 
     * return value - dvourozměrné pole, kde prvním klíčem bude proměnná $grouped, v druhém rozměru budou jednotlivé objekty
     */
    public function groupArray($array, $grouped)
    {
        $result = array();
        foreach ($array as $row) {
            $result[$row->$grouped][] = $row;
        }

        return $result;
    }
    /**
     * vezme pole z proměnné $fullArray a vytvoři pole objektů, kde každému prvku pole bude přiřazeno, jestli se ten prvek vyskytuje i v poli $chosenArray.
     * $fullArray - pole objektů
     * $fullArrayKey - atribut pole fullArray, který bude porovnávat s atributem z druhého pole
     * $chosenArray - pole objektů
     * $chosenArrayKey - atribut pole chosenArray, který bude porovnávat s atributem z druhého pole
     * $chosenName - název prvku objektu, ve kterém bude hodnota 1 (prvek byl v poli) nebo 0 (prvek nebyl v poli)
     * 
     * return value - pole objektů, kde budou prvky z prvního pole obohaceny o nový atribut, kde bude rečeno, jestli daný objekt byl v druhém poli nebo ne.
     */
    public function compareArray($fullArray, $fullArrayKey, $chosenArray, $chosenArrayKey, $chosenName)
    {
        $result = array();
        foreach($fullArray as $row) {
            $smallResult = false;
            foreach ($chosenArray as $item) {
                if($row->$fullArrayKey == $item->$chosenArrayKey) {
                    $smallResult = true;
                }
            }

            $row->$chosenName = $smallResult;
            $result[] = $row;
            
        }

        return $result;
    }
}
