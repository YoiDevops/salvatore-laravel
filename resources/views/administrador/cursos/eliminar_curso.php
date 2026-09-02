<?php
require '../conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No se recibió el ID del curso.");
}

$id = (int)$_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM curso WHERE id_curso = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: cursos.php");
        exit();
    }else{
        echo "Error al eliminar usuario";
    }
?>