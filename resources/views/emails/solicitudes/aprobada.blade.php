<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solicitud aprobada</title>
</head>
<body style="margin:0;background:#f4f6f8;color:#27313a;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f6f8;padding:28px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px;background:#ffffff;border:1px solid #e1e5ea;border-radius:16px;overflow:hidden;">
                    <tr>
                        <td style="background:#27313a;padding:24px 30px;color:#ffffff;">
                            <p style="margin:0;color:#e3c66e;font-size:12px;font-weight:bold;letter-spacing:1.5px;text-transform:uppercase;">Institución Educativa Salvatore</p>
                            <h1 style="margin:10px 0 0;font-size:24px;line-height:1.3;">¡Tu solicitud fue aprobada!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 30px;">
                            <p style="margin:0 0 16px;font-size:16px;line-height:1.6;">Hola {{ $solicitud->acudiente_nombres }},</p>
                            <p style="margin:0 0 20px;font-size:15px;line-height:1.7;">
                                Revisamos la solicitud de inscripción de <strong>{{ $solicitud->estudiante_nombres }} {{ $solicitud->estudiante_apellidos }}</strong> y fue aprobada.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f8f6ef;border:1px solid #eee7d2;border-radius:12px;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <h2 style="margin:0 0 12px;font-size:16px;">Datos para ingresar</h2>
                                        <p style="margin:0 0 8px;font-size:14px;line-height:1.6;"><strong>Documento para ingresar:</strong> {{ $solicitud->estudiante_numero_documento }}</p>
                                        <p style="margin:0 0 8px;font-size:14px;line-height:1.6;"><strong>Correo de contacto:</strong> {{ $solicitud->acudiente_correo }}</p>
                                        <p style="margin:0 0 8px;font-size:14px;line-height:1.6;"><strong>Rol:</strong> Estudiante</p>
                                        <p style="margin:0;font-size:14px;line-height:1.6;"><strong>Contraseña temporal:</strong> <span style="font-family:monospace;">{{ $contrasenaTemporal }}</span></p>
                                        <p style="margin:12px 0 0;font-size:13px;line-height:1.6;">Cámbiala después de ingresar y no la compartas con otras personas.</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:22px 0 12px;font-size:14px;line-height:1.7;">Para continuar, ingresa al portal:</p>
                            <p style="margin:0 0 22px;">
                                <a href="{{ route('login') }}" style="display:inline-block;border-radius:10px;background:#c49a35;padding:12px 20px;color:#1f2529;font-size:14px;font-weight:bold;text-decoration:none;">Ingresar al portal</a>
                            </p>
                            <p style="margin:0 0 12px;color:#27313a;font-size:14px;line-height:1.7;"><strong>Tu cuenta ya está activa.</strong> Ingresa con el documento y la contraseña temporal de este mensaje. La asignación académica está pendiente: la institución te informará el curso o grado que te corresponde.</p>
                            <p style="margin:0;color:#5f6872;font-size:13px;line-height:1.7;">Si necesitas ayuda, responde a este correo.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top:1px solid #e8ebef;padding:18px 30px;color:#68727d;font-size:12px;line-height:1.6;">
                            Este mensaje contiene datos de acceso personales. No compartas tu contraseña con otras personas.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
