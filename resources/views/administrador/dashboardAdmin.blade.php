<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <!--Encabezado del sitio-->
    <header>
    <img class="img_pauta" src="../img/logoSv.png" alt="logo">
        <h1 class="text_pauta">Formamos personas íntegras, críticas y comprometidas con su comunidad y el desarrollo del país.</h1>
    </header>


 <div class="contenido">
     <a href="../index.php" class="salir">
        <i class="fa-solid fa-right-from-bracket"></i>
    </a>
    <div class="dashboard">
    <h2>Panel de Administración</h2>
    <p class="subtitulo-dashboard">
        Bienvenido al sistema de administración de Institucion salvatore.
    </p>
    <div class="dashboard-cards">
        <a href="./usuarios/usuarios.php" class="dashboard-card">
            <i class="fa-solid fa-users"></i>
            <h3>Gestionar Usuarios</h3>
            <p>Administrar usuarios registrados en la plataforma.</p>
        </a>
        <a href="roles/roles.php" class="dashboard-card">
              <i class="fa-solid fa-pen-to-square"></i>
            <h3>Gestionar Roles</h3>
            <p>Configurar permisos y perfiles del sistema.</p>
        </a>

        <a href="../profesor/profesor.php" class="dashboard-card">
              <i class="fa-solid fa-chalkboard-user"></i>
            <h3>Gestionar Profesores</h3>
            <p>administrar usuarios con rol de profesor registrados y informacion adicional .</p>
        </a>

        <a href="../estudiante/estudiante.php" class="dashboard-card">
             <i class="fa-solid fa-user-graduate"></i>
            <h3>Gestionar Estudiantes </h3>
            <p>gestiona usuarios con rol de estudiante registrados y su informacion.</p>
        </a>

        <a href="cursos/cursos.php" class="dashboard-card">
             <i class="fa-solid fa-school"></i>
            <h3>Gestionar cursos</h3>
            <p>gestiona los cursos disponibles.</p>
        </a>

        <a href="cursos/cursos.php" class="dashboard-card">
             <i class="fa-solid fa-school"></i>
            <h3>Gestionar grados</h3>
            <p>gestiona los grados disponibles.</p>
        </a>
        <a href="asignatura/asignatura.php" class="dashboard-card">
             <i class="fa-solid fa-book"></i>
            <h3>Gestiona Asignaturas</h3>
            <p>gestiona las asignaturas y quien las dicta.</p>
        </a>

        <a href="roles/roles.php" class="dashboard-card">
              <i class="fa-solid fa-pen-to-square"></i>
            <h3>asignacion academica</h3>
            <p>asigna los profesores a un grado en especifico.</p>
        </a>

        <a href="roles/roles.php" class="dashboard-card">
              <i class="fa-solid fa-clipboard"></i>
            <h3>escalas de valoracion</h3>
            <p>Crea las escalas de valoracion numeros y letras segun lo establecido.</p>
        </a>
    </div>
</div>
</div>
  
 
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