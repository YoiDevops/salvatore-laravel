<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['id_users' => 1, 'name' => 'andres', 'email' => 'andres@gmail.com', 'role' => 'Administrador', 'status' => 'Activo', 'password' => '$2y$12$/9XGE.NO/HxlbSPBA9STFODc/KoFii8wonKpFsxzWRhqNbAmu7Awi', 'nom_rol' => 'Administrador', 'estado' => 'Activo'],
            ['id_users' => 2, 'name' => 'YOJHAN', 'email' => 'yojhan@gmail.com', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$qFUFtaujvm5SO.FNvOgYqO8/rj1Vd2k9yAXTwBcTEm2nSZWS/65py', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 3, 'name' => 'yoiner', 'email' => 'yoiner@gmail.com', 'role' => 'Administrativo', 'status' => 'Activo', 'password' => '$2y$12$0bPVclvpi1Wae1ZIBSZ3uuJ7gWXNnK2YZlFyt2gPC4WUsfJwFV38u', 'nom_rol' => 'Administrativo', 'estado' => 'Activo'],
            ['id_users' => 4, 'name' => 'juan.gomez', 'email' => 'juan.gomez@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$JU2ickeZyVTHyE1X5m5moOskEvS8g2it0He2DN1bwqh4quCgYRTMi', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 5, 'name' => 'laura.rojas', 'email' => 'laura.rojas@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$zrdGu/Dpx5pzdCLP/xGdDuLkWnrIzcbCk.lFYxxzogcSWBKHR0EJu', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 6, 'name' => 'mateo.smith', 'email' => 'mateo.smith@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$hGWhBxIPF5L/WDalXu8Xxe2uOSEq8phDhoqgs1fQgIKWSzt4vgbGq', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 7, 'name' => 'sofia.mendoza', 'email' => 'sofia.mendoza@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$BkVT9/nwRLA4IQom9HqLAOKfrrXnQtZBGNiOxfTSmbQWlgNhye7by', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 8, 'name' => 'daniel.castro', 'email' => 'daniel.castro@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$DnGzGIADW/IGAwG2g1TrlePkiqtwfMqP6B4/ZO/X9LJd5kwv6g/fK', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 9, 'name' => 'camila.vargas', 'email' => 'camila.vargas@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$cz1uf6LSq5QARAxymts1eeqg2WnH7VWz6w3mFwfDJQNPLqpA.QW0G', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 10, 'name' => 'samuel.morales', 'email' => 'samuel.morales@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$OElB4iaS/K1PMe9ebowgbedVYxTxv9QqTOr78n5KJzD5coz6zuXMu', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 11, 'name' => 'mariana.navarro', 'email' => 'mariana.navarro@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$4j0Gvc7qikEdfMoBXHfpM.nPH0xVeJ1TyzdRD9dCKD1uNMfiS4Zxa', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 12, 'name' => 'nicolas.navarro', 'email' => 'nicolas.navarro@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$kCzGX/m8IiD1.XF3Z3t.aeCfaomnM.ZKMvG0DLUA3H6Wj2h0ukTnq', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 13, 'name' => 'gabriela.benitez', 'email' => 'gabriela.benitez@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$wPyYk3d6XZ4PeYNRs/HbY.FOHutZXY1ybJXcrz6RPyYXZBOeg2r86', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 14, 'name' => 'tomas.pineda', 'email' => 'tomas.pineda@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$tRtnhbmQpMohfNzmB3o5uuPn6MSjYMK.ZbrC.gy50PDtZegIS/fbe', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 15, 'name' => 'isabella.suarez', 'email' => 'isabella.suarez@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$RkjESgJ30fM7n5yzG3tj9Ou8OdARcaoJ9BvvSWVO0iufDBWmoSb6O', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 16, 'name' => 'lucas.johnson', 'email' => 'lucas.johnson@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$4Tz0uGqPkDKIe91CJCT/U.29tzCG9z9u8ULNwDEo/qct5i.PgedNO', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 17, 'name' => 'valeria.camargo', 'email' => 'valeria.camargo@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$YhEjERdZjT/Fht6iQXFDXuJT.LZMeYquNtmjGP7aGGpxBKJyVtPL.', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 18, 'name' => 'emmanuel.rios', 'email' => 'emmanuel.rios@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$spz2c3BkogfJKj6Oj8Utl.hWSMqyaKLfkomJnxL8wowrXZylkjPQC', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 19, 'name' => 'luciana.duarte', 'email' => 'luciana.duarte@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$caiWBES1WBHZL6A/uL/XwuwwkhC8JAAAUKqj3NRfcrKVLYefY9xQK', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 20, 'name' => 'jeronimo.lovera', 'email' => 'jeronimo.lovera@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$gN52Rx3Vyl98prk4EXVjzuIt2wLFmv5sBFn3saYgJ4V23qBVGuPEa', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 21, 'name' => 'salome.bracho', 'email' => 'salome.bracho@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$lTcr8uv7iEhMV5YiQLv/qeuRyhySRwm842DSRpGCr/LyaVxQ.W/Te', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 22, 'name' => 'thiago.ortiz', 'email' => 'thiago.ortiz@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$tDYd0EmO0CPhlpHcBFVVzOFt0mHKOOFbyB/mXgPtIknG..LVvv5KK', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 23, 'name' => 'antonella.mejia', 'email' => 'antonella.mejia@losnaranjos.edu.co', 'role' => 'Estudiante', 'status' => 'Activo', 'password' => '$2y$12$4b4lDVbL2y2vgUCII7/FtOU5F//SAA4zh1bwNgT4TW2u0EBhlaSEi', 'nom_rol' => 'Estudiante', 'estado' => 'Activo'],
            ['id_users' => 24, 'name' => 'roberto.martinez', 'email' => 'roberto.martinez@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$EiawOMMfr/lnOUCJSWg6dumavIGYNxEpCUOLZldAN.SuzDuWkcDwu', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 25, 'name' => 'diana.torres', 'email' => 'diana.torres@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$UT5Nz415YiY5ftKqxPFUnufA8zgmzhaeRxoAvjQY6VQCJTGGWp2NW', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 26, 'name' => 'pedro.ramirez', 'email' => 'pedro.ramirez@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$feoO1cg4k5NsBv8MQn9CxOmG5MRut9qjm3QVF6A637JuAVEkBjMRG', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 27, 'name' => 'martha.zapata', 'email' => 'martha.zapata@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$NIPJ.sd6ZWHf/O4O19KnP.ef89BXi452.cFFlmWeEh1tRwzNG.ML6', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 28, 'name' => 'gonzalo.garcia', 'email' => 'gonzalo.garcia@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$jouHR38VgHlnypD4QdQSqug6M/xnsKNwLtOSto2tN25vy5.jlOBg6', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 29, 'name' => 'luz.ospina', 'email' => 'luz.ospina@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$jyq6aM7KWeZs3A0mciVe.e7t4rDtSxZS7eOTtEGXB.59Ia12LRI3W', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 30, 'name' => 'carlos.jaramillo', 'email' => 'carlos.jaramillo@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$BBrm2Ut.Opf1KMdZ1xJIwe9IWJDVRjZUE3F5pTJlJdi.AjPlA7Taa', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 31, 'name' => 'esperanza.valencia', 'email' => 'esperanza.valencia@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$ZpD5cWn1YD2B3VTSgI.dzuHnCKpnBOuMVicHI88QuS7qFcdCdXAs.', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 32, 'name' => 'jaime.londono', 'email' => 'jaime.londono@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$cSN1W5TSgVOaRoGJ1y1VfeeE3UQamU4.YjPTGxKQotlUtu3IGJXvC', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 33, 'name' => 'beatriz.ceballos', 'email' => 'beatriz.ceballos@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$HQSNMpDgbIZKSjOBetD6HuXREN6FMY60DvC9EfLw0bf3O6yx4tXQu', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 34, 'name' => 'jorge.echeverri', 'email' => 'jorge.echeverri@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$5UsJw0JYlx99gnH34VKHJ.jwxelzpUY1E696.vq6okOih3urQz7Hu', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 35, 'name' => 'adriana.villegas', 'email' => 'adriana.villegas@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$Fq5yPcQtWcRkcsKpsq0LTOmDDnxjAuNt5SWcd2Qtwf790kuxQ7Hja', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 36, 'name' => 'fernando.restrepo', 'email' => 'fernando.restrepo@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$tkaNW3Yiq4k9XPNoZLPPdeptWpNTJdubnINMmfLw5gTTJeHtPXtNG', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 37, 'name' => 'claudia.bedoya', 'email' => 'claudia.bedoya@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$e1QLRC97X2ZY4PshVNZVmu4AxsQwTSIiNvhbGMrX/yz92U/0IVXoa', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 38, 'name' => 'mauricio.montoya', 'email' => 'mauricio.montoya@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$6kN3/xZxqPc.f8aAbnajduBwTOji2xdOoHYea/4zVHfleL35m81iG', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 39, 'name' => 'olga.arango', 'email' => 'olga.arango@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$Jvrc/zbnu6VgXzQA8uL7weIarQdhEkewiBXa.4g5IcewrpevdjtSe', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 40, 'name' => 'henry.quintero', 'email' => 'henry.quintero@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$kgkPgXIdln7MX27UUq.ybODDJhWuw9XqIOj0o62WPk4rivjqEnEOC', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 41, 'name' => 'sonia.giraldo', 'email' => 'sonia.giraldo@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$Nz0m9YPE.u6YEPcMgNnf8u9PTJJpxobM5eweKdspeA9FXVgQFT72u', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 42, 'name' => 'cesar.duque', 'email' => 'cesar.duque@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$b9Xm1Hmgrj.RyNMswIBw.OTVm017o60lbJruz86VDz9VlPs8GdWKa', 'nom_rol' => 'Profesor', 'estado' => 'Activo'],
            ['id_users' => 43, 'name' => 'pilar.munera', 'email' => 'pilar.munera@losnaranjos.edu.co', 'role' => 'Profesor', 'status' => 'Activo', 'password' => '$2y$12$DAF7ClWApBsXgDivKw9gteznjCHXoZiB32fm2GKk.v7xj.JDRwvrO', 'nom_rol' => 'Profesor', 'estado' => 'Activo']
        ];

        DB::table('users')->upsert(
            $usuarios,
            ['id_users'], // Columna unica
            ['name', 'email', 'role', 'status', 'password', 'nom_rol', 'estado'] // Se actualizan si el registro ya existe
        );
    }
}