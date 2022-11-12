<?php
namespace Models;

use Config\conexion;
use PDO;

class posts
{
    public $mbd;
    public function __construct(){
        $this->mbd = (new conexion())->mbd;
    }

    public function getPostsByDate($fecha_ini, $fecha_fin){
        // hacer consulta en la tabla posts y traerme su usario, dependiendo la fehca inicio y la fecha fin
        $query = $this->mbd->prepare('SELECT * FROM posts as p INNER JOIN personas as pe ON pe.id = p.id_persona WHERE p.fecha_ini = ? AND p.fecha_fin = ?');
        $query->bindParam(1, $fecha_ini);
        $query->bindParam(2, $fecha_fin);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}