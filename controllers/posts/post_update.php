<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("UPDATE posts SET id_persona = :id_persona, titulo = :titulo, cuerpo = :cuerpo, fecha_borrado = :fecha_borrado, nro_reacciones = :nro_reacciones, puntuacion = :puntuacion, correo_origen = :correo_origen WHERE id = :id");

    $statement->bindParam(':id', $id);
    $statement->bindParam(':id_persona', $id_persona);
    $statement->bindParam(':titulo', $titulo);
    $statement->bindParam(':cuerpo', $cuerpo);
    $statement->bindParam(':fecha_borrado', $fecha_borrado);
    $statement->bindParam(':nro_reacciones', $nro_reacciones);
    $statement->bindParam(':puntuacion', $puntuacion);
    $statement->bindParam(':correo_origen', $correo_origen);

    $id = $_POST['id'];
    $id_persona = $_POST['id_persona'];
    $titulo = $_POST['titulo'];
    $cuerpo = $_POST['cuerpo'];
    $fecha_borrado = $_POST['fecha_borrado'];
    $nro_reacciones = $_POST['nro_reacciones'];
    $puntuacion = $_POST['puntuacion'];
    $correo_origen = $_POST['correo_origen'];

    $statement->execute();

    $statement = $mbd->prepare("SELECT * FROM posts WHERE id = ". $_POST['id']);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
  
    $statement = $mbd->prepare("SELECT * FROM personas WHERE id = ". $post['id_persona']);
    $statement->execute();
    $persona = $statement->fetch(PDO::FETCH_ASSOC);  

    $post['data_fk'] = $persona;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro actualizado satisfactoriamente",
        "data" => $post
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
