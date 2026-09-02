<?php
require '../conexion.php';

$valor = '';

if (!empty($_POST['dato'])) {
    $valor = trim($_POST['dato']);
    $stmt = $mysqli->prepare(
        "SELECT * FROM usuario WHERE usuario LIKE ? OR correo LIKE ?"
    );
    $buscar = "%$valor%";
    $stmt->bind_param("ss", $buscar, $buscar);
    $stmt->execute();
    $resultado_usuarios = $stmt->get_result();
} else {
    $resultado_usuarios = $mysqli->query("SELECT * FROM usuario ORDER BY usuario ASC");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form.css">
    <title>Administrar usuarios</title>
    <link rel="shortcut icon" href="../../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <img class="img_pauta" src="../../img/logo.png" alt="Logo AutoShop">
    <h1 class="text_pauta">GESTION DE USUARIOS </h1>
</header>

<div class="menu">
    <ul>
        <li><a href="../dashboard.php"><i class="fa-solid fa-boxes-stacked"></i> INICIO</a></li>
        <li><a href="agregar.php" class="btn-agregar"><i class="fa-solid fa-circle-plus"></i> AGREGAR USUARIO</a></li>
        <li><a href="#" class="btn-editar" onclick="return editarUsuarioSeleccionado();"><i class="fa-solid fa-pen-to-square"></i> ACTUALIZAR USUARIO</a></li>
        <li><a href="#" class="btn-eliminar" onclick="return eliminarUsuarioSeleccionado();"><i class="fa-solid fa-trash"></i> BORRAR USUARIO</a></li>
    </ul>

    <form method="POST" action="" class="buscar">
        <input type="text" name="dato" id="buscarCategoria" class="dato" placeholder="Buscar usuario..."
        value="<?php echo isset($_POST['dato']) ? htmlspecialchars($_POST['dato']) : ''; ?>">
        <button type="submit" class="btn_buscar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>

<div class="contenido">
    <section class="seccion" style="max-width: 1000px; width: 90%;"> 
        <h2>Administrar usuarios</h2>
        
        <div class="boxers">
            <div class="tabla-contenedor"> <!-- Añadida esta clase de tu CSS para controlar el desborde -->
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Correo</th>
                            <th>Password</th>
                            <th>Rol</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($resultado_usuarios && $resultado_usuarios->num_rows > 0) { ?>
                        <?php while ($row_user = $resultado_usuarios->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <input type="checkbox"
                                           class="usuario-check"
                                           value="<?php echo $row_user['id_usuario']; ?>"
                                           onchange="seleccionarUsuario(this)">
                                </td>
                                <td><?php echo htmlspecialchars($row_user['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($row_user['correo']); ?></td>
                                <td><?php echo htmlspecialchars($row_user['password']); ?></td>
                                <td><?php echo htmlspecialchars($row_user['id_rol']); ?></td>
                                <td><?php echo htmlspecialchars($row_user['estado']); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No hay usuarios registrados.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<form id="formEditarUsuario" method="get" action="editar.php">
    <input type="hidden" name="id" id="idUsuarioEditar">
</form>

<form id="formEliminarUsuario" method="get" action="eliminar.php" onsubmit="return confirmarEliminar();">
    <input type="hidden" name="id" id="idUsuarioEliminar">
</form>

<script>
function seleccionarUsuario(checkbox) {
    const checks = document.querySelectorAll('.usuario-check');
    const seleccionados = [...checks].filter(c => c.checked);

    if (seleccionados.length > 1) {
        checkbox.checked = false;
        alert('Solo puedes seleccionar un usuario a la vez.');
        return;
    }

    document.getElementById('idUsuarioEditar').value = seleccionados.length ? seleccionados[0].value : '';
    document.getElementById('idUsuarioEliminar').value = seleccionados.length ? seleccionados[0].value : '';
}

function editarUsuarioSeleccionado() {
    const id = document.getElementById('idUsuarioEditar').value;
    if (!id) {
        alert('Por favor selecciona un usuario para actualizar.');
        return false;
    }
    document.getElementById('formEditarUsuario').submit();
    return false;
}

function eliminarUsuarioSeleccionado() {
    const id = document.getElementById('idUsuarioEliminar').value;
    if (!id) {
        alert('Por favor selecciona un usuario para borrar.');
        return false;
    }
    document.getElementById('formEliminarUsuario').submit();
    return false;
}

function confirmarEliminar() {
    const id = document.getElementById('idUsuarioEliminar').value;
    if (!id) {
        alert('Por favor selecciona un usuario para borrar.');
        return false;
    }
    return confirm('¿Seguro que deseas eliminar este usuario?');
}
</script>

<!--pie de pagina-->
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