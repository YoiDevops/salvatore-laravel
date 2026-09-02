<?php
require 'conexion.php';

if (!isset($_POST['botactualizar'])) {
    header('Location: cursos.php');
    exit();
}
$idcurso = (int)$_POST["idcurso"];
$Sede= trim($_POST["sed"] ?? '');
$Grado= trim($_POST["gra"] ?? '');
$Jornada = trim($_POST["jor"] ?? '');
$Nombrecur= trim($_POST["nombrecur"] ?? ''); 
$cupomax = trim($_POST["cupomax"] ?? '');


$stmt = $mysqli->prepare(
    "UPDATE curso SET id_sede = ?, id_grado = ?, id_jornada = ?, nombre_curso = ?, cupo_maximo = ? WHERE id_curso = ?"
);
$stmt->bind_param('iiissi', $Sede, $Grado, $Jornada, $Nombrecur, $cupomax,$idcurso);

if ($stmt->execute()) {
    echo "<script>alert('Curso actualizado correctamente'); window.location='cursos.php';</script>";
} else {
    echo "Error al actualizar: " . $stmt->error;
}
