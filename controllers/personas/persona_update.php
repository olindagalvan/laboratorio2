<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("UPDATE personas SET nombre = :nombre,  correo = :correo, edad = :edad WHERE id = :id");

    $statement->bindParam(':id', $id);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':correo', $correo);
    $statement->bindParam(':edad', $edad);

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];

    $statement->execute();
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro actualizado satisfactoriamente",
        "data" => [
            "id" => $id,
            "descripcion" => "Desarrollo Web II"
        ]
    ]);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
