<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM posts");
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($posts); $i++) {
        $statement = $mbd->prepare("SELECT * FROM personas where id = ". $posts[$i]['id_persona']);
        $statement->execute();
        $persona = $statement->fetch(PDO::FETCH_ASSOC);
        $posts[$i]['data_fk'] = $persona;
    }

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($posts);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
