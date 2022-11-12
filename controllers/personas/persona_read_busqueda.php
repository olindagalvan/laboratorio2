<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM personas WHERE id = :id");

    $statement->bindParam(':id', $id);

    $id = $_GET['id'];      
    $statement->execute();
    $results = $statement->fetch(PDO::FETCH_ASSOC);

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "persona" => $results        
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
