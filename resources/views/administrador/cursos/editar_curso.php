<?php
require 'conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('No se recibió el ID del curso.');
}

$id = (int)$_GET['id'];

$stmt = $mysqli->prepare("SELECT * FROM curso WHERE id_curso = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die('No se encontró el curso.');
}

$cursos = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../css/dashboard.css">
     <link rel="stylesheet" href="../../css/form.css">
    <link rel="shortcut icon" href="../../img/logo.png " type="image/x-icon">
    <title>AGREGAR CURSOS</title> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>

 <h1 class="text_pauta">ACTUALIZA UN CURSO</h1>
</header>

<form class="form-basico" name="formulario" method="post" action="guardar_editar.php" onsubmit="return validar()" >
       <input type="hidden" name="idcurso" value="<?php echo $cursos['id_curso']; ?>">

        <div class="titulo">
            <h2>ACTUALIZAR UN CURSO</h2>
        </div>
       <div class="entrada">
            <label>Sede</label>
            <select name="sed" required>
                <option value="0">Selecciona una Sede</option>
                <option value="1" <?php if(($cursos['id_sede'] ?? '') == '1') echo 'selected'; ?>>Sede Principal</option>
                <option value="2" <?php if(($cursos['id_sede'] ?? '') == '2') echo 'selected'; ?>>Sede Norte</option>
                <option value="3" <?php if(($cursos['id_sede'] ?? '') == '3') echo 'selected'; ?>>Sede Sur</option>
                <option value="4" <?php if(($cursos['id_sede'] ?? '') == '4') echo 'selected'; ?>>Sede Occidente</option>
                <option value="5" <?php if(($cursos['id_sede'] ?? '') == '5') echo 'selected'; ?>>Sede Oriente</option>
            </select>
        </div>
        <div class="entrada">
            <label>Grado</label>
            <select name="gra" required>
                <option value="0">Selecciona un grado</option>
                <option value="1"<?php if($cursos['id_grado'] == 1) echo 'selected'; ?>>Primero</option>
                <option value="2"<?php if($cursos['id_grado'] == 2) echo 'selected'; ?>>Segundo</option>
                <option value="3"<?php if($cursos['id_grado'] == 3) echo 'selected'; ?>>Tercero</option>
                <option value="4"<?php if($cursos['id_grado'] == 4) echo 'selected'; ?>>Cuarto</option>
                <option value="5"<?php if($cursos['id_grado'] == 5) echo 'selected'; ?>>Quinto</option>
            </select>
        </div>

        <div class="entrada">
            <label>Jornada</label>
            <select name="jor" required>
                <option value="">Seleccione una jornada</option>
                <option value="1"<?php if($cursos['id_jornada'] == 1) echo 'selected'; ?>>Mañana</option>
                <option value="2"<?php if($cursos['id_jornada'] == 2) echo 'selected'; ?>>Tarde</option>
            </select>
        </div>
        <div class="entrada">
            <label>nombre curso</label>
            <input type="text"  name="nombrecur" value="<?php echo $cursos['nombre_curso'] ?? ''; ?>" required>
        </div>

        <div class="entrada">
            <label>cupo maximo</label>
            <input type="text"  name="cupomax" value="<?php echo $cursos['cupo_maximo'] ?? ''; ?>" required>
        </div>

        <div class="boton">
            <input type="submit" name="botactualizar" value="Guardar">
        </div>
</form>

 <footer>
            <br><br>
     
    <!--seccion de informacion-->
     <footer id="contacto" class="pie-pagina">

        <div class="redes-sociales">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        </div>

        <div class="informacion-contacto">
            <div class="contacto">
                <i class="fa-regular fa-envelope"></i>
                <span>colegio@salvatore.edu.co</span>
            </div>
            <div class="contacto">
                <i class="fa-solid fa-phone"></i>
                <span>(601) 742 5893</span>
            </div>
            <div class="contacto">
                <i class="fa-solid fa-location-dot"></i>
                <span>Bogotá, Colombia</span>
            </div>
        </div>

        <div class="pie-copyright">
            <p><i class="fa-regular fa-copyright"></i> 2026 - Institución Educativa Salvatore</p>
        </div>
    </footer>
</body>
</html>