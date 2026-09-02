<?php
require '../conexion.php';

$where = "";

if(isset($_POST['dato']) && !empty(trim($_POST['dato']))){
    $valor = $mysqli->real_escape_string($_POST['dato']);
    $where = "WHERE nombre_rol LIKE '%$valor%'"; // Corregido: se busca por nombre_rol
}

$sql = "SELECT id_rol, nombre_rol
        FROM rol
        $where";

$resultado = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form.css">
    <title>Dashboard Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="interface-wrapper"> <!-- Contenedor opcional para envolver todo -->

    <!-- Encabezado del sitio (CORREGIDO EL INTERRUPTOR '<<') -->
    <header>
        <h1 class="text_pauta">GESTION DE ROLES SALVATORE</h1>
    </header>

    <!-- Menú de navegación -->
    <div class="menu"> 
        <ul>
            <li><a href="agregar_rol.php"><i class="fa-solid fa-user-plus"></i> CREAR ROL</a></li>
            <li><a href="#" onclick="editarRol()"><i class="fa-solid fa-user-pen"></i> ACTUALIZAR ROL</a></li>
            <li><a href="#" onclick="eliminarRol()"><i class="fa-solid fa-user-xmark"></i> ELIMINAR ROL</a></li> 
            <li><a href="../dashboard.php"><i class="fa-solid fa-person-walking-arrow-right"></i> VOLVER</a></li>
        </ul>
        
        <!-- Formulario de búsqueda -->
        <form method="POST" action="roles.php" class="buscar">
            <input type="text" name="dato" id="buscarRol" class="dato" placeholder="Buscar Rol..."
                   value="<?php echo isset($_POST['dato']) ? htmlspecialchars($_POST['dato']) : ''; ?>">
            <button type="submit" class="btn_buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <!-- Contenido Principal -->
    <div class="contenido">
        <section class="seccion">
            <h2>Roles Registrados</h2>

            <div class="tabla-contenedor">
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($fila = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td>
                                <input type="radio" name="id" value="<?php echo $fila['id_rol']; ?>" required>
                            </td>
                            <td><?php echo $fila['nombre_rol']; ?></td> <!-- CORREGIDO: 'rol' por 'nombre_rol' -->
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Pie de página -->
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

</div>

<!-- Formularios ocultos de acciones -->
<form id="formEditar" action="actualizar_rol.php" method="POST" style="display:none;">
    <input type="hidden" name="id" id="idSeleccionado">
</form>

<form id="formEliminar" action="borrar.php" method="POST" style="display:none;">
    <input type="hidden" name="id" id="idEliminar">
</form>

<script>
function editarRol(){
    let seleccionado = document.querySelector('input[name="id"]:checked');
    if(!seleccionado){
        Swal.fire({ title: "Debe seleccionar un Rol.", icon: "error" });
        return;
    }
    document.getElementById("idSeleccionado").value = seleccionado.value;
    document.getElementById("formEditar").submit();
}

function eliminarRol(){
    let seleccionado = document.querySelector('input[name="id"]:checked');
    if(!seleccionado){
        Swal.fire({ title: "Debe seleccionar un Rol.", icon: "error" });
        return;
    }
    if(confirm("¿Está seguro de eliminar este rol?")){
        document.getElementById("idEliminar").value = seleccionado.value;
        document.getElementById("formEliminar").submit();
    }
}
</script>
</body>
</html>