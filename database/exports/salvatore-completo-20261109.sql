-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: salvatore
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acudiente`
--

DROP TABLE IF EXISTS `acudiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acudiente` (
  `id_acudiente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_documento` enum('CC','TI','CE','PASAPORTE','PEP','PPT') NOT NULL,
  `documento_identidad` varchar(20) NOT NULL,
  `nombres_acudiente` varchar(50) NOT NULL,
  `apellidos_acudiente` varchar(50) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `parentesco_estudiante` varchar(30) NOT NULL,
  `direccion_residencia` varchar(150) DEFAULT NULL,
  `telefono_acudiente` varchar(20) DEFAULT NULL,
  `correo_acudiente` varchar(100) DEFAULT NULL,
  `lugar_trabajo` varchar(100) DEFAULT NULL,
  `ocupacion` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_acudiente`),
  UNIQUE KEY `acudiente_documento_identidad_unique` (`documento_identidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acudiente`
--

LOCK TABLES `acudiente` WRITE;
/*!40000 ALTER TABLE `acudiente` DISABLE KEYS */;
/*!40000 ALTER TABLE `acudiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archivos_excel`
--

DROP TABLE IF EXISTS `archivos_excel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivos_excel` (
  `id_archivo_excel` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_original` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `tamano` bigint(20) unsigned NOT NULL DEFAULT 0,
  `id_usuario` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_archivo_excel`),
  KEY `archivos_excel_id_usuario_index` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivos_excel`
--

LOCK TABLES `archivos_excel` WRITE;
/*!40000 ALTER TABLE `archivos_excel` DISABLE KEYS */;
/*!40000 ALTER TABLE `archivos_excel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id_area` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(60) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id_area`),
  UNIQUE KEY `area_nombre_area_unique` (`nombre_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignatura` (
  `id_asignatura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_area` int(10) unsigned NOT NULL,
  `nombre_asignatura` varchar(80) NOT NULL,
  `intensidad_horaria` tinyint(3) unsigned NOT NULL,
  `porcentaje_area` decimal(5,2) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id_asignatura`),
  KEY `asignatura_id_area_index` (`id_area`),
  CONSTRAINT `asignatura_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignatura`
--

LOCK TABLES `asignatura` WRITE;
/*!40000 ALTER TABLE `asignatura` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracterizacion_discapacidad`
--

DROP TABLE IF EXISTS `caracterizacion_discapacidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracterizacion_discapacidad` (
  `id_caracterizacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_discapacidad` varchar(60) NOT NULL,
  `diagnostico` text DEFAULT NULL,
  `grado_discapacidad` enum('Leve','Moderada','Severa') NOT NULL,
  `permanencia` enum('Temporal','Permanente') NOT NULL,
  `grado_atencion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_caracterizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracterizacion_discapacidad`
--

LOCK TABLES `caracterizacion_discapacidad` WRITE;
/*!40000 ALTER TABLE `caracterizacion_discapacidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `caracterizacion_discapacidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso` (
  `id_curso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sede` int(10) unsigned NOT NULL,
  `id_grado` int(10) unsigned NOT NULL,
  `nombre_curso` varchar(15) NOT NULL,
  `cupo_maximo` varchar(10) NOT NULL,
  `jornada` varchar(10) DEFAULT NULL,
  `ano_lectivo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `curso_id_sede_index` (`id_sede`),
  KEY `curso_id_grado_index` (`id_grado`),
  CONSTRAINT `curso_id_grado_foreign` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`),
  CONSTRAINT `curso_id_sede_foreign` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escala_valoracion`
--

DROP TABLE IF EXISTS `escala_valoracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escala_valoracion` (
  `id_escala` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_desempeno` enum('Superior','Alto','Basico','Bajo') NOT NULL,
  `nota_minima` decimal(1,0) NOT NULL,
  `nota_maxima` decimal(5,0) NOT NULL,
  `definicion_escala` text DEFAULT NULL,
  PRIMARY KEY (`id_escala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escala_valoracion`
--

LOCK TABLES `escala_valoracion` WRITE;
/*!40000 ALTER TABLE `escala_valoracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `escala_valoracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `id_estudiante` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_curso` int(10) unsigned NOT NULL,
  `id_acudiente` int(10) unsigned NOT NULL,
  `id_caracterizacion` int(10) unsigned DEFAULT NULL,
  `tipo_documento` enum('RC','TI','CC','CE','PASAPORTE','PPT') NOT NULL,
  `documento_identidad` varchar(20) NOT NULL,
  `nombres_estudiante` varchar(50) NOT NULL,
  `apellidos_estudiante` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `tipo_sangre` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `lugar_nacimiento` varchar(80) DEFAULT NULL,
  `eps` varchar(80) DEFAULT NULL,
  `estado_estudiante` enum('Activo','Retirado','Graduado','Suspendido') DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`),
  UNIQUE KEY `estudiante_id_usuario_unique` (`id_usuario`),
  UNIQUE KEY `estudiante_documento_identidad_unique` (`documento_identidad`),
  KEY `estudiante_id_curso_index` (`id_curso`),
  KEY `estudiante_id_acudiente_index` (`id_acudiente`),
  KEY `estudiante_id_caracterizacion_index` (`id_caracterizacion`),
  CONSTRAINT `estudiante_id_acudiente_foreign` FOREIGN KEY (`id_acudiente`) REFERENCES `acudiente` (`id_acudiente`),
  CONSTRAINT `estudiante_id_caracterizacion_foreign` FOREIGN KEY (`id_caracterizacion`) REFERENCES `caracterizacion_discapacidad` (`id_caracterizacion`),
  CONSTRAINT `estudiante_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grado`
--

DROP TABLE IF EXISTS `grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grado` (
  `id_grado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_grado` varchar(25) NOT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado`
--

LOCK TABLES `grado` WRITE;
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicador_logro`
--

DROP TABLE IF EXISTS `indicador_logro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicador_logro` (
  `id_indicador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_asignatura` int(10) unsigned NOT NULL,
  `id_periodo` int(10) unsigned NOT NULL,
  `id_escala` int(10) unsigned NOT NULL,
  `codigo_logro` varchar(20) DEFAULT NULL,
  `descripcion_logro` text NOT NULL,
  `tipo_logro` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_indicador`),
  KEY `indicador_logro_id_asignatura_index` (`id_asignatura`),
  KEY `indicador_logro_id_periodo_index` (`id_periodo`),
  KEY `indicador_logro_id_escala_index` (`id_escala`),
  CONSTRAINT `indicador_logro_id_asignatura_foreign` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  CONSTRAINT `indicador_logro_id_escala_foreign` FOREIGN KEY (`id_escala`) REFERENCES `escala_valoracion` (`id_escala`),
  CONSTRAINT `indicador_logro_id_periodo_foreign` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicador_logro`
--

LOCK TABLES `indicador_logro` WRITE;
/*!40000 ALTER TABLE `indicador_logro` DISABLE KEYS */;
/*!40000 ALTER TABLE `indicador_logro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institucion`
--

DROP TABLE IF EXISTS `institucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institucion` (
  `nit` varchar(20) NOT NULL,
  `nombre_institucion` varchar(120) NOT NULL,
  `direccion_principal` varchar(150) NOT NULL,
  `telefono_contacto` varchar(20) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `registro_dane` varchar(30) DEFAULT NULL,
  `resolucion_aprobacion` varchar(50) DEFAULT NULL,
  `url_logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nit`),
  UNIQUE KEY `institucion_registro_dane_unique` (`registro_dane`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion`
--

LOCK TABLES `institucion` WRITE;
/*!40000 ALTER TABLE `institucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `institucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (52,'2026_11_05_000001_create_solicitudes_table',1),(53,'2026_11_05_000002_create_archivos_excel_table',1),(54,'2026_11_05_000003_remove_administrativo_role',1),(55,'0001_01_01_000000_create_users_table',2),(56,'0001_01_01_000001_create_cache_table',2),(57,'0001_01_01_000002_create_jobs_table',2),(58,'2024_01_01_000000_create_passkeys_table',2),(59,'2025_08_14_170933_add_two_factor_columns_to_users_table',2),(60,'2026_08_21_151800_create_institucion_table',2),(61,'2026_08_21_151801_create_sede_table',2),(62,'2026_08_21_151802_create_grado_table',2),(63,'2026_08_21_151803_create_curso_table',2),(64,'2026_08_21_151804_create_acudiente_table',2),(65,'2026_08_21_151805_create_caracterizacion_discapacidad_table',2),(66,'2026_08_21_151807_create_estudiante_table',2),(67,'2026_08_21_151808_create_profesor_table',2),(68,'2026_08_21_151809_create_area_table',2),(69,'2026_08_21_151810_create_asignatura_table',2),(70,'2026_08_21_151811_create_periodo_table',2),(71,'2026_08_21_151812_create_escala_valoracion_table',2),(72,'2026_08_21_151814_create_indicador_logro_table',2),(73,'2026_08_24_214259_create_rol_table',2),(74,'2026_09_02_000000_drop_teams_tables',2),(75,'2026_09_07_173044_add_role_and_status_to_users_table',2),(76,'2026_09_10_000000_add_administrativo_role',2),(77,'2026_09_10_000001_allow_custom_role_names',2),(78,'2026_09_10_000002_seed_invitado_role',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passkeys`
--

DROP TABLE IF EXISTS `passkeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passkeys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `credential_id` varchar(255) NOT NULL,
  `credential` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`credential`)),
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passkeys_credential_id_unique` (`credential_id`),
  KEY `passkeys_id_users_index` (`id_users`),
  CONSTRAINT `passkeys_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passkeys`
--

LOCK TABLES `passkeys` WRITE;
/*!40000 ALTER TABLE `passkeys` DISABLE KEYS */;
/*!40000 ALTER TABLE `passkeys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `id_periodo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_periodo` varchar(30) NOT NULL,
  `porcentaje_periodo` decimal(5,2) NOT NULL,
  `anio_lectivo` year(4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor` (
  `id_profesor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `tipo_documento` enum('CC','CE','PASAPORTE','PPT') NOT NULL,
  `documento_profesor` varchar(20) NOT NULL,
  `nombres_profesor` varchar(50) NOT NULL,
  `apellidos_profesor` varchar(50) NOT NULL,
  `telefono_profesor` varchar(20) DEFAULT NULL,
  `correo_profesor` varchar(100) DEFAULT NULL,
  `direccion_residencia` varchar(150) DEFAULT NULL,
  `fecha_ingreso_colegio` date DEFAULT NULL,
  `tipo_contra` varchar(50) DEFAULT NULL,
  `estado_profesor` enum('Activo','Inactivo','Licencia') DEFAULT NULL,
  PRIMARY KEY (`id_profesor`),
  UNIQUE KEY `profesor_id_usuario_unique` (`id_usuario`),
  UNIQUE KEY `profesor_documento_profesor_unique` (`documento_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(80) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Invitado'),(2,'Administrador'),(3,'Administrativo'),(4,'Profesor'),(5,'Estudiante');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sede`
--

DROP TABLE IF EXISTS `sede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sede` (
  `id_sede` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nit` varchar(20) NOT NULL,
  `nombre_sede` varchar(80) NOT NULL,
  `direccion_sede` varchar(150) DEFAULT NULL,
  `telefono_sede` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_sede`),
  KEY `sede_nit_index` (`nit`),
  CONSTRAINT `sede_nit_foreign` FOREIGN KEY (`nit`) REFERENCES `institucion` (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sede`
--

LOCK TABLES `sede` WRITE;
/*!40000 ALTER TABLE `sede` DISABLE KEYS */;
/*!40000 ALTER TABLE `sede` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`),
  CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes` (
  `id_solicitud` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estudiante_tipo_documento` varchar(30) NOT NULL,
  `estudiante_numero_documento` varchar(30) NOT NULL,
  `estudiante_nombres` varchar(100) NOT NULL,
  `estudiante_apellidos` varchar(100) NOT NULL,
  `estudiante_fecha_nacimiento` date NOT NULL,
  `estudiante_genero` varchar(30) NOT NULL,
  `estudiante_tipo_sangre` varchar(10) NOT NULL,
  `estudiante_lugar_nacimiento` varchar(100) NOT NULL,
  `estudiante_eps` varchar(100) NOT NULL,
  `estudiante_estado` varchar(30) NOT NULL DEFAULT 'Activo',
  `estudiante_tiene_discapacidad` varchar(5) NOT NULL,
  `estudiante_tipo_discapacidad` varchar(100) DEFAULT NULL,
  `estudiante_diagnostico_discapacidad` varchar(150) DEFAULT NULL,
  `estudiante_grado_discapacidad` varchar(50) DEFAULT NULL,
  `estudiante_permanencia_discapacidad` varchar(50) DEFAULT NULL,
  `estudiante_grado_atencion` varchar(100) DEFAULT NULL,
  `acudiente_tipo_documento` varchar(30) NOT NULL,
  `acudiente_numero_documento` varchar(30) NOT NULL,
  `acudiente_nombres` varchar(100) NOT NULL,
  `acudiente_apellidos` varchar(100) NOT NULL,
  `acudiente_fecha_nacimiento` date NOT NULL,
  `acudiente_genero` varchar(30) NOT NULL,
  `acudiente_parentesco` varchar(60) NOT NULL,
  `acudiente_direccion` varchar(150) NOT NULL,
  `acudiente_telefono` varchar(30) NOT NULL,
  `acudiente_correo` varchar(150) NOT NULL,
  `acudiente_lugar_trabajo` varchar(150) DEFAULT NULL,
  `acudiente_ocupacion` varchar(100) DEFAULT NULL,
  `estado_solicitud` varchar(30) NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `solicitudes_estudiante_numero_documento_index` (`estudiante_numero_documento`),
  KEY `solicitudes_acudiente_numero_documento_index` (`acudiente_numero_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes`
--

LOCK TABLES `solicitudes` WRITE;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;
INSERT INTO `solicitudes` VALUES (1,'TI','23131312313','malak','sdf','2001-01-01','Masculino','O+','ad','ads','Activo','No',NULL,NULL,NULL,NULL,NULL,'CC','13123','dqw','sfsdf','2008-01-01','Masculino','Padre','sadsasd','3123213131','sdads@gmail.com','dads','dadsd','Pendiente','2026-11-06 00:43:29','2026-11-06 00:43:29');
/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_users` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Usuario',
  `status` varchar(255) NOT NULL DEFAULT 'Activo',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `nom_rol` varchar(25) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'andres','andres@gmail.com','Administrador','Activo',NULL,'$2y$12$/9XGE.NO/HxlbSPBA9STFODc/KoFii8wonKpFsxzWRhqNbAmu7Awi',NULL,NULL,NULL,'Administrador','Activo',NULL,NULL,NULL),(2,'YOJHAN','yojhan@gmail.com','Profesor','Activo',NULL,'$2y$12$qFUFtaujvm5SO.FNvOgYqO8/rj1Vd2k9yAXTwBcTEm2nSZWS/65py',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(3,'yoiner','yoiner@gmail.com','Administrativo','Activo',NULL,'$2y$12$0bPVclvpi1Wae1ZIBSZ3uuJ7gWXNnK2YZlFyt2gPC4WUsfJwFV38u',NULL,NULL,NULL,'Administrativo','Activo',NULL,NULL,NULL),(4,'juan.gomez','juan.gomez@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$JU2ickeZyVTHyE1X5m5moOskEvS8g2it0He2DN1bwqh4quCgYRTMi',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(5,'laura.rojas','laura.rojas@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$zrdGu/Dpx5pzdCLP/xGdDuLkWnrIzcbCk.lFYxxzogcSWBKHR0EJu',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(6,'mateo.smith','mateo.smith@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$hGWhBxIPF5L/WDalXu8Xxe2uOSEq8phDhoqgs1fQgIKWSzt4vgbGq',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(7,'sofia.mendoza','sofia.mendoza@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$BkVT9/nwRLA4IQom9HqLAOKfrrXnQtZBGNiOxfTSmbQWlgNhye7by',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(8,'daniel.castro','daniel.castro@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$DnGzGIADW/IGAwG2g1TrlePkiqtwfMqP6B4/ZO/X9LJd5kwv6g/fK',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(9,'camila.vargas','camila.vargas@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$cz1uf6LSq5QARAxymts1eeqg2WnH7VWz6w3mFwfDJQNPLqpA.QW0G',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(10,'samuel.morales','samuel.morales@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$OElB4iaS/K1PMe9ebowgbedVYxTxv9QqTOr78n5KJzD5coz6zuXMu',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(11,'mariana.navarro','mariana.navarro@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$4j0Gvc7qikEdfMoBXHfpM.nPH0xVeJ1TyzdRD9dCKD1uNMfiS4Zxa',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(12,'nicolas.navarro','nicolas.navarro@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$kCzGX/m8IiD1.XF3Z3t.aeCfaomnM.ZKMvG0DLUA3H6Wj2h0ukTnq',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(13,'gabriela.benitez','gabriela.benitez@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$wPyYk3d6XZ4PeYNRs/HbY.FOHutZXY1ybJXcrz6RPyYXZBOeg2r86',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(14,'tomas.pineda','tomas.pineda@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$tRtnhbmQpMohfNzmB3o5uuPn6MSjYMK.ZbrC.gy50PDtZegIS/fbe',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(15,'isabella.suarez','isabella.suarez@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$RkjESgJ30fM7n5yzG3tj9Ou8OdARcaoJ9BvvSWVO0iufDBWmoSb6O',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(16,'lucas.johnson','lucas.johnson@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$4Tz0uGqPkDKIe91CJCT/U.29tzCG9z9u8ULNwDEo/qct5i.PgedNO',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(17,'valeria.camargo','valeria.camargo@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$YhEjERdZjT/Fht6iQXFDXuJT.LZMeYquNtmjGP7aGGpxBKJyVtPL.',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(18,'emmanuel.rios','emmanuel.rios@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$spz2c3BkogfJKj6Oj8Utl.hWSMqyaKLfkomJnxL8wowrXZylkjPQC',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(19,'luciana.duarte','luciana.duarte@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$caiWBES1WBHZL6A/uL/XwuwwkhC8JAAAUKqj3NRfcrKVLYefY9xQK',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(20,'jeronimo.lovera','jeronimo.lovera@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$gN52Rx3Vyl98prk4EXVjzuIt2wLFmv5sBFn3saYgJ4V23qBVGuPEa',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(21,'salome.bracho','salome.bracho@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$lTcr8uv7iEhMV5YiQLv/qeuRyhySRwm842DSRpGCr/LyaVxQ.W/Te',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(22,'thiago.ortiz','thiago.ortiz@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$tDYd0EmO0CPhlpHcBFVVzOFt0mHKOOFbyB/mXgPtIknG..LVvv5KK',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(23,'antonella.mejia','antonella.mejia@losnaranjos.edu.co','Estudiante','Activo',NULL,'$2y$12$4b4lDVbL2y2vgUCII7/FtOU5F//SAA4zh1bwNgT4TW2u0EBhlaSEi',NULL,NULL,NULL,'Estudiante','Activo',NULL,NULL,NULL),(24,'roberto.martinez','roberto.martinez@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$EiawOMMfr/lnOUCJSWg6dumavIGYNxEpCUOLZldAN.SuzDuWkcDwu',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(25,'diana.torres','diana.torres@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$UT5Nz415YiY5ftKqxPFUnufA8zgmzhaeRxoAvjQY6VQCJTGGWp2NW',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(26,'pedro.ramirez','pedro.ramirez@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$feoO1cg4k5NsBv8MQn9CxOmG5MRut9qjm3QVF6A637JuAVEkBjMRG',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(27,'martha.zapata','martha.zapata@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$NIPJ.sd6ZWHf/O4O19KnP.ef89BXi452.cFFlmWeEh1tRwzNG.ML6',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(28,'gonzalo.garcia','gonzalo.garcia@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$jouHR38VgHlnypD4QdQSqug6M/xnsKNwLtOSto2tN25vy5.jlOBg6',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(29,'luz.ospina','luz.ospina@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$jyq6aM7KWeZs3A0mciVe.e7t4rDtSxZS7eOTtEGXB.59Ia12LRI3W',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(30,'carlos.jaramillo','carlos.jaramillo@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$BBrm2Ut.Opf1KMdZ1xJIwe9IWJDVRjZUE3F5pTJlJdi.AjPlA7Taa',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(31,'esperanza.valencia','esperanza.valencia@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$ZpD5cWn1YD2B3VTSgI.dzuHnCKpnBOuMVicHI88QuS7qFcdCdXAs.',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(32,'jaime.londono','jaime.londono@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$cSN1W5TSgVOaRoGJ1y1VfeeE3UQamU4.YjPTGxKQotlUtu3IGJXvC',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(33,'beatriz.ceballos','beatriz.ceballos@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$HQSNMpDgbIZKSjOBetD6HuXREN6FMY60DvC9EfLw0bf3O6yx4tXQu',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(34,'jorge.echeverri','jorge.echeverri@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$5UsJw0JYlx99gnH34VKHJ.jwxelzpUY1E696.vq6okOih3urQz7Hu',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(35,'adriana.villegas','adriana.villegas@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$Fq5yPcQtWcRkcsKpsq0LTOmDDnxjAuNt5SWcd2Qtwf790kuxQ7Hja',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(36,'fernando.restrepo','fernando.restrepo@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$tkaNW3Yiq4k9XPNoZLPPdeptWpNTJdubnINMmfLw5gTTJeHtPXtNG',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(37,'claudia.bedoya','claudia.bedoya@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$e1QLRC97X2ZY4PshVNZVmu4AxsQwTSIiNvhbGMrX/yz92U/0IVXoa',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(38,'mauricio.montoya','mauricio.montoya@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$6kN3/xZxqPc.f8aAbnajduBwTOji2xdOoHYea/4zVHfleL35m81iG',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(39,'olga.arango','olga.arango@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$Jvrc/zbnu6VgXzQA8uL7weIarQdhEkewiBXa.4g5IcewrpevdjtSe',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(40,'henry.quintero','henry.quintero@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$kgkPgXIdln7MX27UUq.ybODDJhWuw9XqIOj0o62WPk4rivjqEnEOC',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(41,'sonia.giraldo','sonia.giraldo@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$Nz0m9YPE.u6YEPcMgNnf8u9PTJJpxobM5eweKdspeA9FXVgQFT72u',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(42,'cesar.duque','cesar.duque@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$b9Xm1Hmgrj.RyNMswIBw.OTVm017o60lbJruz86VDz9VlPs8GdWKa',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL),(43,'pilar.munera','pilar.munera@losnaranjos.edu.co','Profesor','Activo',NULL,'$2y$12$DAF7ClWApBsXgDivKw9gteznjCHXoZiB32fm2GKk.v7xj.JDRwvrO',NULL,NULL,NULL,'Profesor','Activo',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'salvatore'
--

--
-- Dumping routines for database 'salvatore'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-09 14:09:02
