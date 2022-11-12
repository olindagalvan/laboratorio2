<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("DELETE FROM personas WHERE id = :id");

    $statement->bindParam(':id', $id);

    $id = $_POST['id'];

    $statement->execute();
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro eliminado satisfactoriamnte",
        "data " => [
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
