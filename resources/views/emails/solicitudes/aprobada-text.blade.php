Institución Educativa Salvatore

¡Tu solicitud fue aprobada!

Hola {{ $solicitud->acudiente_nombres }},

La solicitud de inscripción de {{ $solicitud->estudiante_nombres }} {{ $solicitud->estudiante_apellidos }} fue aprobada.

Documento para ingresar: {{ $solicitud->estudiante_numero_documento }}
Correo de contacto: {{ $solicitud->acudiente_correo }}
Rol: Estudiante
Contraseña temporal: {{ $contrasenaTemporal }}
Cámbiala después de ingresar y no la compartas con otras personas.

Ingresa al portal: {{ route('login') }}

Tu cuenta ya está activa. Ingresa con el documento y la contraseña temporal de este mensaje. La asignación académica está pendiente; la institución te informará el curso o grado que te corresponde.
No compartas tu contraseña con otras personas.
