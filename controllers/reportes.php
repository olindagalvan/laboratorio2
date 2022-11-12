<?php

namespace Controllers;



use Models\posts;
use Utils\validationDate;

class reportes
{
    public function date()
    {

        $validations = new validationDate();
        if (!isset($_POST['fecha_ini']) || !isset($_POST['fecha_fin'])){
            echo $this->response('No se han enviado las fechas', 400);
            return;
        }else{
            $fecha_inicio = $_POST['fecha_ini'];
            $fecha_fin = $_POST['fecha_fin'];
            if ($validations->validated_date($fecha_inicio) && $validations->validated_date($fecha_fin)){
                $fecha_inicio = $validations->reformat_date($fecha_inicio);
                $fecha_fin = $validations->reformat_date($fecha_fin);
                $posts = new posts();
                $reportes = $posts->getPostsByDate($fecha_inicio, $fecha_fin);
                echo $this->response($reportes);
                return;
            } else {
                echo $this->response('Las fechas no son válidas, debe de tener el formate dd/mm/aaaa', 400);
                return;
            }
        }
    }

    public function response($data, $status = 200)
    {
        http_response_code($status);
        return json_encode($data);
    }
}