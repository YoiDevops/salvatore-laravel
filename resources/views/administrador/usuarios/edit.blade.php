<?php
require '../conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No se recibió el ID del usuario.");
}

$id = (int)$_GET['id'];

$stmt = $mysqli->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Usuario no encontrado.");
}

$usuario = $resultado->fetch_assoc();

// Separar nombre y apellido del campo usuario
$partes = explode(" ", $usuario['usuario'], 2);

$nombre = $partes[0];
$apellido = $partes[1] ?? "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>

    <link rel="stylesheet" href="../../css/form.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>

<div class="menu">
    <ul>
        <li><a href="usuarios.php"><i class="fa-solid fa-arrow-left"></i> VOLVER</a></li>
    </ul>
</div>

<form class="form-basico" method="post" action="guardar_editar.php">

    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

    <div class="titulo">
        <h2>ACTUALIZAR USUARIO</h2>
    </div>

<div class="entrada">
    <label>Nombre</label>
    <input
        type="text"
        name="nom"
        value="<?php echo htmlspecialchars($nombre); ?>"
        readonly>
</div>

<div class="entrada">
    <label>Apellido</label>
    <input
        type="text"
        name="ape"
        value="<?php echo htmlspecialchars($apellido); ?>"
        readonly>
</div>
      <div class="entrada">
            <label>Tipo de documento</label>
            <select name="t_doc" required>
                <option value="">Seleccione una Opción</option>
                <option value="Tarjeta de identidad" <?php if(($usuario['id_doc'] ?? '') == 'Tarjeta de identidad') echo 'selected'; ?>>Tarjeta de identidad</option>
                <option value="Cedula de Ciudadania" <?php if(($usuario['id_doc'] ?? '') == 'Cedula de Ciudadania') echo 'selected'; ?>>Cedula de Ciudadania</option>
                <option value="Cedula de Extranjeria" <?php if(($usuario['id_doc'] ?? '') == 'Cedula de Extranjeria') echo 'selected'; ?>>Cedula de Extranjeria</option>
                <option value="Pasaporte" <?php if(($usuario['id_doc'] ?? '') == 'Pasaporte') echo 'selected'; ?>>Pasaporte</option>
            </select>
        </div>

    <div class="entrada">
        <label>Documento</label>
        <input
            type="text"
            name ="doc"
            value="*****"
            readonly>
    </div>

    <div class="entrada">
        <label>Correo</label>
        <input
            type="email"
            name="correo"
            value="<?php echo htmlspecialchars($usuario['correo']); ?>"
            required>
    </div>

    <div class="entrada">
        <label>Contraseña</label>
        <input
            type="password"
            name="pass"
            placeholder="Dejar vacío para conservar la contraseña">
    </div>

    <div class="entrada">
        <label>Rol</label>

        <select name="rol_usuario" required>

            <option value="1"
                <?php if($usuario['id_rol']==1) echo "selected"; ?>>
                Administrador
            </option>

            <option value="2"
                <?php if($usuario['id_rol']==2) echo "selected"; ?>>
                Profesor
            </option>

            <option value="3"
                <?php if($usuario['id_rol']==3) echo "selected"; ?>>
                Acudiente
            </option>

        </select>
    </div>

    <div class="boton">
        <input
            type="submit"
            name="botactualizar"
            value="Actualizar Usuario">
    </div>

</form>

</body>
</html>