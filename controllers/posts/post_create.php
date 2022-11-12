<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("INSERT INTO posts (id_persona, titulo, cuerpo, fecha_borrado, nro_reacciones, puntuacion, correo_origen) 
    VALUES (:id_persona, :titulo, :cuerpo, :fecha_borrado, :nro_reacciones, :puntuacion, :correo_origen)");

    $statement->bindParam(':id_persona', $id_persona);
    $statement->bindParam(':titulo', $titulo);
    $statement->bindParam(':cuerpo', $cuerpo);
    $statement->bindParam(':fecha_borrado', $fecha_borrado);
    $statement->bindParam(':nro_reacciones', $nro_reacciones);
    $statement->bindParam(':puntuacion', $puntuacion);
    $statement->bindParam(':correo_origen', $correo_origen);

    $id_persona = $_POST['id_persona'];
    $titulo = $_POST['titulo'];
    $cuerpo = $_POST['cuerpo'];
    $fecha_borrado = $_POST['fecha_borrado'];
    $nro_reacciones = $_POST['nro_reacciones'];
    $puntuacion = $_POST['puntuacion'];
    $correo_origen = $_POST['correo_origen'];

    $statement->execute();
    $_POST['id'] = $mbd->lastInsertId();

    $statement = $mbd->prepare("SELECT * FROM personas WHERE id = ". $_POST['id_persona']);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $_POST['data_fk'] = $data;

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
