<?php
require 'conexion.php'; 

$where = "";

if(isset($_POST['dato']) && !empty(trim($_POST['dato']))){
    $valor = $mysqli->real_escape_string($_POST['dato']);
    $where = "WHERE nombre_curso LIKE '%$valor%'"; 
}


$sql = "SELECT id_curso, id_sede, id_grado, id_jornada, nombre_curso, cupo_maximo
        FROM curso
        $where";

$resultado = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form.css">
    <title>Dashboard Cursos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="interface-wrapper"> 

    <!-- Encabezado del sitio -->
    <header>
        <h1 class="text_pauta">GESTIÓN DE CURSOS - SALVATORE</h1>
    </header>

    <!-- Menú de navegación -->
    <div class="menu"> 
        <ul>
            <li><a href="agregar_curso.php"><i class="fa-solid fa-file-circle-plus"></i> CREAR CURSO</a></li>
            <li><a href="#" onclick="editarCurso()"><i class="fa-solid fa-file-pen"></i> ACTUALIZAR CURSO</a></li>
            <li><a href="#" onclick="eliminarCursoSeleccionado()"><i class="fa-solid fa-file-circle-xmark"></i> ELIMINAR CURSO</a></li> 
            <li><a href="../dashboard.php"><i class="fa-solid fa-person-walking-arrow-right"></i> VOLVER</a></li>
        </ul>
        
        <!-- Formulario de búsqueda (Apuntando al archivo actual, asumiendo gestion_cursos.php) -->
        <form method="POST" action="cursos.php" class="buscar"> 
            <input type="text" name="dato" id="buscarCurso" class="dato" placeholder="Buscar por Nombre Curso..."
                   value="<?php echo isset($_POST['dato']) ? htmlspecialchars($_POST['dato']) : ''; ?>">
            <button type="submit" class="btn_buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <!-- Contenido Principal -->
    <div class="contenido">
        <section class="seccion">
            <h2>Cursos Registrados</h2>

            <div class="tabla-contenedor">
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>ID Sede</th>
                            <th>ID Grado</th>
                            <th>ID Jornada</th>
                            <th>Nombre Curso</th>
                            <th>Cupo Máximo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($resultado) { 
                        while($fila = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td>
                                <!-- El id_curso se queda de forma interna sin columna visible -->
                                <input type="radio" name="id" value="<?php echo $fila['id_curso']; ?>" required>
                            </td>
                            <td><?php echo $fila['id_sede']; ?></td>
                            <td><?php echo $fila['id_grado']; ?></td>
                            <td><?php echo $fila['id_jornada']; ?></td>
                            <td><?php echo $fila['nombre_curso']; ?></td>
                            <td><?php echo $fila['cupo_maximo']; ?></td>
                        </tr>
                    <?php } 
                    } ?>
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

<form id="formEditar" action="editar_curso.php" method="get" style="display:none;">
    <input type="hidden" name="id" id="idSeleccionado">
</form>
<form id="formEliminarCurso" method="get" action="eliminar_curso.php" onsubmit="return confirmarEliminar();">
    <input type="hidden" name="id" id="idCursoEliminar">
</form>


<script>
function editarCurso(){
    let seleccionado = document.querySelector('input[name="id"]:checked');

    if(!seleccionado){
        Swal.fire({
            title: "Debe seleccionar un Curso.",
            icon: "error"
        });
        return false;
    }

    document.getElementById("idSeleccionado").value = seleccionado.value;
    document.getElementById("formEditar").submit();
    return false;
}

function eliminarCursoSeleccionado() {

    let seleccionado = document.querySelector('input[name="id"]:checked');

    if(!seleccionado){
        Swal.fire({
            title: "Debe seleccionar un Curso.",
            icon: "error"
        });
        return false;
    }

    document.getElementById('idCursoEliminar').value = seleccionado.value;

    document.getElementById('formEliminarCurso').requestSubmit();

    return false;
}

function confirmarEliminar() {

    const id = document.getElementById('idCursoEliminar').value;

    if(!id){
        alert('Por favor selecciona un curso para borrar.');
        return false;
    }

    return confirm('¿Seguro que deseas eliminar este curso?');
}
</script>
</body>
</html>



