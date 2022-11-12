<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once '../vendor/autoload.php';
require_once '../config/router.php';
require_once  '../controllers/reportes.php';
require_once '../config/conexion.php';
require_once '../models/posts.php';
require_once '../utils/ValidationDate.php';

use Config\router;
use Controllers\reportes;


$router = new router();
$router->resolve($_SERVER);
$router->post('/reportes', [reportes::class, 'date']);

