<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form.css">
    <title>AGREGAR USUARIO</title> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="menu"> 
    <ul>
    <li><a href="../index.php"><i class="fa-solid fa-boxes-stacked"></i> INICIO</a></li>
    </ul>
</div>
 
 <form class="form-basico" name="formulario" method="post" action="guardar_agregar.php" onsubmit="return validar()" >
        <div class="titulo">
            <h2>AGREGAR NUEVO USUARIO</h2>
        </div>
<div class="entrada">
            <label>Nombre</label>
            <input type="text"  name="nom">
        </div>
        <div class="entrada">
            <label>Apellido</label>
            <input type="text"  name="ape">
        </div>

            <div class="entrada">
        <label>Usuario</label> 
        <input type="text" name="usu">
    </div>

        <div class="entrada">
            <label>Tipo de documento</label>
            <select name="t_doc" required>
                <option value="">Seleccione una opción</option>
                <option value="1">CC</option>
                <option value="2">TI</option>
                <option value="3">CE</option>
                <option value="4">Pasaporte</option>
                <option value="5">PEP</option>
            </select>
        </div>
        <div class="entrada">
            <label>Documento</label>
            <input type="text"  name="doc">
        </div>
        <div class="entrada">
            <label>Correo Electrónico</label>
            <input type="email"  name="correo">
        </div>
       
        <div class="entrada">
            <label>Contraseña</label>
            <input type="password" name="pass">
        </div>

        <div class="entrada">
            <label>Rol de Usuario</label>
            <select name="rol_usuario">
                <option value="">Seleccione un Rol</option>
                <option value="1">Administrador</option>
                <option value="2">Profesor</option>
                <option value="3">Acudiente</option>
            </select>
        </div>
               
      
        <div class="boton">
            <input type="submit" name="botregistrar" value="Guardar">
        </div>
</form>
<script>
    function validar() {
        var opcion = document.formulario.condiciones; 
        var rol = document.formulario.rol_usuario.value;

        // Valida que el administrador seleccione un rol obligatoriamente
        if(rol == "") {
            Swal.fire({
                title: 'Oops!',
                html: 'Debes seleccionar un rol para este usuario',
                icon: 'error'
            });
            return false;
        }

        if (opcion.checked == true) { 
            Swal.fire({
                title: 'Perfecto!',
                html: 'Los datos han sido enviados correctamente',
                icon: 'success'
            });
            return true; 
        } else {
            Swal.fire({
                title: 'Oops!',
                html: 'Debes aceptar las condiciones para continuar',
                icon: 'error'
            });
            return false; 
        }
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