<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosColegioTableSeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            [1, 'andres', 'andres@gmail.com', 'Administrador', '$2y$12$/9XGE.NO/HxlbSPBA9STFODc/KoFii8wonKpFsxzWRhqNbAmu7Awi'],
            [2, 'YOJHAN', 'yojhan@gmail.com', 'Profesor', '$2y$12$qFUFtaujvm5SO.FNvOgYqO8/rj1Vd2k9yAXTwBcTEm2nSZWS/65py'],
            [3, 'yoiner', 'yoiner@gmail.com', 'Administrativo', '$2y$12$0bPVclvpi1Wae1ZIBSZ3uuJ7gWXNnK2YZlFyt2gPC4WUsfJwFV38u'],
            [4, 'juan.gomez', 'juan.gomez@losnaranjos.edu.co', 'Estudiante', '$2y$12$JU2ickeZyVTHyE1X5m5moOskEvS8g2it0He2DN1bwqh4quCgYRTMi'],
            [5, 'laura.rojas', 'laura.rojas@losnaranjos.edu.co', 'Estudiante', '$2y$12$zrdGu/Dpx5pzdCLP/xGdDuLkWnrIzcbCk.lFYxxzogcSWBKHR0EJu'],
            [6, 'mateo.smith', 'mateo.smith@losnaranjos.edu.co', 'Estudiante', '$2y$12$hGWhBxIPF5L/WDalXu8Xxe2uOSEq8phDhoqgs1fQgIKWSzt4vgbGq'],
            [7, 'sofia.mendoza', 'sofia.mendoza@losnaranjos.edu.co', 'Estudiante', '$2y$12$BkVT9/nwRLA4IQom9HqLAOKfrrXnQtZBGNiOxfTSmbQWlgNhye7by'],
            [8, 'daniel.castro', 'daniel.castro@losnaranjos.edu.co', 'Estudiante', '$2y$12$DnGzGIADW/IGAwG2g1TrlePkiqtwfMqP6B4/ZO/X9LJd5kwv6g/fK'],
            [9, 'camila.vargas', 'camila.vargas@losnaranjos.edu.co', 'Estudiante', '$2y$12$cz1uf6LSq5QARAxymts1eeqg2WnH7VWz6w3mFwfDJQNPLqpA.QW0G'],
            [10, 'samuel.morales', 'samuel.morales@losnaranjos.edu.co', 'Estudiante', '$2y$12$OElB4iaS/K1PMe9ebowgbedVYxTxv9QqTOr78n5KJzD5coz6zuXMu'],
            [11, 'mariana.navarro', 'mariana.navarro@losnaranjos.edu.co', 'Estudiante', '$2y$12$4j0Gvc7qikEdfMoBXHfpM.nPH0xVeJ1TyzdRD9dCKD1uNMfiS4Zxa'],
            [12, 'nicolas.navarro', 'nicolas.navarro@losnaranjos.edu.co', 'Estudiante', '$2y$12$kCzGX/m8IiD1.XF3Z3t.aeCfaomnM.ZKMvG0DLUA3H6Wj2h0ukTnq'],
            [13, 'gabriela.benitez', 'gabriela.benitez@losnaranjos.edu.co', 'Estudiante', '$2y$12$wPyYk3d6XZ4PeYNRs/HbY.FOHutZXY1ybJXcrz6RPyYXZBOeg2r86'],
            [14, 'tomas.pineda', 'tomas.pineda@losnaranjos.edu.co', 'Estudiante', '$2y$12$tRtnhbmQpMohfNzmB3o5uuPn6MSjYMK.ZbrC.gy50PDtZegIS/fbe'],
            [15, 'isabella.suarez', 'isabella.suarez@losnaranjos.edu.co', 'Estudiante', '$2y$12$RkjESgJ30fM7n5yzG3tj9Ou8OdARcaoJ9BvvSWVO0iufDBWmoSb6O'],
            [16, 'lucas.johnson', 'lucas.johnson@losnaranjos.edu.co', 'Estudiante', '$2y$12$4Tz0uGqPkDKIe91CJCT/U.29tzCG9z9u8ULNwDEo/qct5i.PgedNO'],
            [17, 'valeria.camargo', 'valeria.camargo@losnaranjos.edu.co', 'Estudiante', '$2y$12$YhEjERdZjT/Fht6iQXFDXuJT.LZMeYquNtmjGP7aGGpxBKJyVtPL.'],
            [18, 'emmanuel.rios', 'emmanuel.rios@losnaranjos.edu.co', 'Estudiante', '$2y$12$spz2c3BkogfJKj6Oj8Utl.hWSMqyaKLfkomJnxL8wowrXZylkjPQC'],
            [19, 'luciana.duarte', 'luciana.duarte@losnaranjos.edu.co', 'Estudiante', '$2y$12$caiWBES1WBHZL6A/uL/XwuwwkhC8JAAAUKqj3NRfcrKVLYefY9xQK'],
            [20, 'jeronimo.lovera', 'jeronimo.lovera@losnaranjos.edu.co', 'Estudiante', '$2y$12$gN52Rx3Vyl98prk4EXVjzuIt2wLFmv5sBFn3saYgJ4V23qBVGuPEa'],
            [21, 'salome.bracho', 'salome.bracho@losnaranjos.edu.co', 'Estudiante', '$2y$12$lTcr8uv7iEhMV5YiQLv/qeuRyhySRwm842DSRpGCr/LyaVxQ.W/Te'],
            [22, 'thiago.ortiz', 'thiago.ortiz@losnaranjos.edu.co', 'Estudiante', '$2y$12$tDYd0EmO0CPhlpHcBFVVzOFt0mHKOOFbyB/mXgPtIknG..LVvv5KK'],
            [23, 'antonella.mejia', 'antonella.mejia@losnaranjos.edu.co', 'Estudiante', '$2y$12$4b4lDVbL2y2vgUCII7/FtOU5F//SAA4zh1bwNgT4TW2u0EBhlaSEi'],
            [24, 'roberto.martinez', 'roberto.martinez@losnaranjos.edu.co', 'Profesor', '$2y$12$EiawOMMfr/lnOUCJSWg6dumavIGYNxEpCUOLZldAN.SuzDuWkcDwu'],
            [25, 'diana.torres', 'diana.torres@losnaranjos.edu.co', 'Profesor', '$2y$12$UT5Nz415YiY5ftKqxPFUnufA8zgmzhaeRxoAvjQY6VQCJTGGWp2NW'],
            [26, 'pedro.ramirez', 'pedro.ramirez@losnaranjos.edu.co', 'Profesor', '$2y$12$feoO1cg4k5NsBv8MQn9CxOmG5MRut9qjm3QVF6A637JuAVEkBjMRG'],
            [27, 'martha.zapata', 'martha.zapata@losnaranjos.edu.co', 'Profesor', '$2y$12$NIPJ.sd6ZWHf/O4O19KnP.ef89BXi452.cFFlmWeEh1tRwzNG.ML6'],
            [28, 'gonzalo.garcia', 'gonzalo.garcia@losnaranjos.edu.co', 'Profesor', '$2y$12$jouHR38VgHlnypD4QdQSqug6M/xnsKNwLtOSto2tN25vy5.jlOBg6'],
            [29, 'luz.ospina', 'luz.ospina@losnaranjos.edu.co', 'Profesor', '$2y$12$jyq6aM7KWeZs3A0mciVe.e7t4rDtSxZS7eOTtEGXB.59Ia12LRI3W'],
            [30, 'carlos.jaramillo', 'carlos.jaramillo@losnaranjos.edu.co', 'Profesor', '$2y$12$BBrm2Ut.Opf1KMdZ1xJIwe9IWJDVRjZUE3F5pTJlJdi.AjPlA7Taa'],
            [31, 'esperanza.valencia', 'esperanza.valencia@losnaranjos.edu.co', 'Profesor', '$2y$12$ZpD5cWn1YD2B3VTSgI.dzuHnCKpnBOuMVicHI88QuS7qFcdCdXAs.'],
            [32, 'jaime.londono', 'jaime.londono@losnaranjos.edu.co', 'Profesor', '$2y$12$cSN1W5TSgVOaRoGJ1y1VfeeE3UQamU4.YjPTGxKQotlUtu3IGJXvC'],
            [33, 'beatriz.ceballos', 'beatriz.ceballos@losnaranjos.edu.co', 'Profesor', '$2y$12$HQSNMpDgbIZKSjOBetD6HuXREN6FMY60DvC9EfLw0bf3O6yx4tXQu'],
            [34, 'jorge.echeverri', 'jorge.echeverri@losnaranjos.edu.co', 'Profesor', '$2y$12$5UsJw0JYlx99gnH34VKHJ.jwxelzpUY1E696.vq6okOih3urQz7Hu'],
            [35, 'adriana.villegas', 'adriana.villegas@losnaranjos.edu.co', 'Profesor', '$2y$12$Fq5yPcQtWcRkcsKpsq0LTOmDDnxjAuNt5SWcd2Qtwf790kuxQ7Hja'],
            [36, 'fernando.restrepo', 'fernando.restrepo@losnaranjos.edu.co', 'Profesor', '$2y$12$tkaNW3Yiq4k9XPNoZLPPdeptWpNTJdubnINMmfLw5gTTJeHtPXtNG'],
            [37, 'claudia.bedoya', 'claudia.bedoya@losnaranjos.edu.co', 'Profesor', '$2y$12$e1QLRC97X2ZY4PshVNZVmu4AxsQwTSIiNvhbGMrX/yz92U/0IVXoa'],
            [38, 'mauricio.montoya', 'mauricio.montoya@losnaranjos.edu.co', 'Profesor', '$2y$12$6kN3/xZxqPc.f8aAbnajduBwTOji2xdOoHYea/4zVHfleL35m81iG'],
            [39, 'olga.arango', 'olga.arango@losnaranjos.edu.co', 'Profesor', '$2y$12$Jvrc/zbnu6VgXzQA8uL7weIarQdhEkewiBXa.4g5IcewrpevdjtSe'],
            [40, 'henry.quintero', 'henry.quintero@losnaranjos.edu.co', 'Profesor', '$2y$12$kgkPgXIdln7MX27UUq.ybODDJhWuw9XqIOj0o62WPk4rivjqEnEOC'],
            [41, 'sonia.giraldo', 'sonia.giraldo@losnaranjos.edu.co', 'Profesor', '$2y$12$Nz0m9YPE.u6YEPcMgNnf8u9PTJJpxobM5eweKdspeA9FXVgQFT72u'],
            [42, 'cesar.duque', 'cesar.duque@losnaranjos.edu.co', 'Profesor', '$2y$12$b9Xm1Hmgrj.RyNMswIBw.OTVm017o60lbJruz86VDz9VlPs8GdWKa'],
            [43, 'pilar.munera', 'pilar.munera@losnaranjos.edu.co', 'Profesor', '$2y$12$DAF7ClWApBsXgDivKw9gteznjCHXoZiB32fm2GKk.v7xj.JDRwvrO'],
        ];
        $rows = [];

        foreach ($records as [$id, $name, $email, $role, $password]) {
            $rows[] = [
                'id_users' => $id,
                'name' => $name,
                'email' => $email,
                'role' => $role,
                'status' => 'Activo',
                'password' => $password,
                'nom_rol' => $role,
                'estado' => 'Activo',
            ];
        }

        DB::table('users')->upsert($rows, ['id_users'], ['name', 'email', 'role', 'status', 'password', 'nom_rol', 'estado']);
    }
}
