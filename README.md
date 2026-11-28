# salvatore-laravel

## Correo de aprobación de solicitudes

En local, el proyecto usa `MAIL_MAILER=log` por defecto. Después de configurar el archivo `.env`, ejecuta `php artisan config:clear`, registra una solicitud y apruébala desde **Administrativo → Solicitudes en espera**. El mensaje de prueba quedará en `storage/logs/laravel.log`; contiene la contraseña temporal, así que no compartas ni publiques ese archivo.

Para probar el acceso de la cuenta aprobada, usa el número de documento del estudiante y la contraseña temporal del correo. Administradores, administrativos y las cuentas de prueba del equipo pueden ingresar con su usuario o correo y su contraseña actual.

Para enviar correos reales, configura `MAIL_MAILER=smtp`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_SCHEME`, `MAIL_FROM_ADDRESS` y `MAIL_FROM_NAME` con los datos del proveedor, y luego ejecuta `php artisan config:clear`. No guardes credenciales SMTP en el repositorio. La cuenta aprobada puede cambiar su contraseña en **Configuración → Seguridad**.

## Asignaciones académicas

Ejecuta `php artisan migrate` para crear la tabla de cargas académicas. Desde el panel administrativo, **Cargas académicas** permite relacionar un profesor, una asignatura y un curso, además de registrar las horas semanales. La asignación de curso para estudiantes se administra desde **Estudiantes**, al crear o editar su ficha. Las solicitudes de matrícula no incluyen curso ni grado: al aprobarlas se activa la cuenta de estudiante y la asignación académica queda pendiente para que la institución la complete después.