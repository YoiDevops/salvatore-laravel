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

 <h1 class="text_pauta">AGREGA UN NUEVO CURSO</h1>
</header>
<form class="form-basico" name="formulario" method="post" action="guardar_agregar.php" onsubmit="return validar()" >
        <div class="titulo">
            <h2>AGREGAR NUEVO CURSO</h2>
        </div>
       <div class="entrada">
            <label>Sede</label>
            <select name="sed" required>
                <option value="0">Selecciona una Sede</option>
                <option value="1">Sede Principal</option>
                <option value="2">Sede Norte</option>
                <option value="3">Sede Sur</option>
                <option value="4">Sede Occidente</option>
                <option value="5">Sede Oriente</option>
            </select>
        </div>
        <div class="entrada">
            <label>Grado</label>
            <select name="gra" required>
                <option value="0">Selecciona un grado</option>
                <option value="1">Primero</option>
                <option value="2">Segundo</option>
                <option value="3">Tercero</option>
                <option value="4">Cuarto</option>
                <option value="5">Quinto</option>
            </select>
        </div>

        <div class="entrada">
            <label>Jornada</label>
            <select name="jor" required>
                <option value="">Seleccione una jornada</option>
                <option value="1">Mañana</option>
                <option value="2">Tarde</option>
            </select>
        </div>
        <div class="entrada">
            <label>nombre curso</label>
            <input type="text"  name="nombrecur" required>
        </div>

        <div class="entrada">
            <label>cupo maximo</label>
            <input type="text"  name="cupomax" required>
        </div>

        <div class="boton">
            <input type="submit" name="botregistrar" value="Guardar">
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