<?php
namespace Utils;

class validationDate
{
    public function validated_date($fecha){
        $valores = explode('/', $fecha);
        if (count($valores) != 3) return false;
        if (strlen($valores[0]) != 2) return false;
        if (strlen($valores[1]) != 2) return false;
        if (strlen($valores[2]) != 4) return false;
        if (!checkdate($valores[1], $valores[0], $valores[2])) return false;
        return true;
    }

    public function reformat_date($fecha): string
    {
        $valores = explode('/', $fecha);
        return $valores[2].'-'.$valores[1].'-'.$valores[0];
    }
}