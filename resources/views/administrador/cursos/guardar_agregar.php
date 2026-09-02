<?php
// Conectando a la base de datos
require 'conexion.php';

// Pasando datos del formulario
// Recoger y sanitizar entradas
$Sede= trim($_POST["sed"] ?? '');
$Grado= trim($_POST["gra"] ?? '');
$Jornada = trim($_POST["jor"] ?? '');
$Nombrecur= trim($_POST["nombrecur"] ?? ''); 
$cupomax = trim($_POST["cupomax"] ?? '');


if(isset($_POST["botregistrar"])){

    // Validar campos esenciales
    if($Sede === '' || $Grado === '' || $Jornada === '' || $Nombrecur === '' || $cupomax === '' ){
        die("Faltan campos requeridos.");
    }

    $stmt = $mysqli->prepare("INSERT INTO curso (id_sede,id_grado, id_jornada,nombre_curso, cupo_maximo) VALUES (?, ?, ?, ?, ?)");
    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    $stmt->bind_param('iiiss', $Sede, $Grado, $Jornada, $Nombrecur, $cupomax);
    if($stmt->execute()){
        echo "<script> alert('Curso registrado con éxito: $Nombrecur'); window.location='cursos.php'</script>";
    } else {
        die('Error en la ejecución: ' . $stmt->error);
    }
    $stmt->close();
}
?>