<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM posts WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_GET['id'];      
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $mbd->prepare("SELECT * FROM personas WHERE id = ". $post['id_persona']);
    $statement->execute();
    $persona = $statement->fetch(PDO::FETCH_ASSOC);  

    $post['data_fk'] = $persona;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "post" => $post        
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
