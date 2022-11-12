<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("INSERT INTO personas (nombre, correo, edad) VALUES (:nombre, :correo, :edad)");

    $statement->bindParam(':nombre', $olinda);
    $statement->bindParam(':correo', $olindagalvan);
    $statement->bindParam(':edad', $29);

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];  

    $statement->execute();
    $_POST['id'] = $mbd->lastInsertId();
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($_POST);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
