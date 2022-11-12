<?php
namespace Config;
use PDO;
use PDOException;

class conexion
{
    public $mbd;
    public function __construct()
    {
        try {
            $mbd = new PDO('mysql:host=localhost;dbname=posts', 'root', '');
            $mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $mbd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->mbd = $mbd;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}